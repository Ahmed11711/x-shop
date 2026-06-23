<?php

namespace App\Http\Middleware;

use App\Models\Central\FeaturePackage;
use App\Models\Central\Package;
use App\Models\Central\Tenant as CentralTenant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class SyncFeaturePackageAfterResponse
{
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }

    public function terminate(Request $request, Response $response): void
    {
        Log::info('SyncFeaturePackage middleware started', [
            'method' => $request->method(),
            'path'   => $request->path(),
        ]);

        if (! $this->shouldSync($request, $response)) {
            Log::warning('Sync skipped because shouldSync returned false');
            return;
        }

        try {

            if ($request->method() === 'DELETE') {
                $this->handleDeleteSync($request);
                return;
            }

            $featurePackageId = $request->route('feature_package');

            if (is_null($featurePackageId) && $request->method() === 'POST') {
                $responseData     = json_decode($response->getContent(), true);
                $featurePackageId = $responseData['data']['id'] ?? $responseData['id'] ?? null;
            }

            Log::info('Feature package id detected', [
                'feature_package_id' => $featurePackageId
            ]);

            $featurePackage = FeaturePackage::find($featurePackageId);

            if (! $featurePackage) {
                Log::error('FeaturePackage not found', ['id' => $featurePackageId]);
                return;
            }

            $package = Package::with(['featurePackages.feature'])
                ->find($featurePackage->package_id);

            if (! $package) {
                Log::error('Package not found', ['package_id' => $featurePackage->package_id]);
                return;
            }

            Log::info('Package found', [
                'package_id'     => $package->id,
                'features_count' => $package->featurePackages->count()
            ]);

            $featuresMap = $package->featurePackages->mapWithKeys(function ($fp) {
                return [
                    $fp->feature->key => [
                        'total_limit' => $fp->value,
                        'type'        => $fp->key_feature ?? 'numeric',
                        'is_enabled'  => $fp->is_enabled ?? true,
                    ]
                ];
            });

            $currentKeys = $featuresMap->keys()->toArray();

            $tenants = CentralTenant::whereHas('subscription', function ($query) use ($package) {
                $query->where('package_id', $package->id)
                    ->where('active', true);
            })->get();

            Log::info('Tenants found', ['count' => $tenants->count()]);

            foreach ($tenants as $tenant) {

                Log::info('Sync started for tenant', ['tenant_id' => $tenant->id]);

                try {
                    $this->connectToTenant($tenant);
                    $this->syncTenantFeatures($featuresMap, $currentKeys);
                    Log::info('Sync completed for tenant', ['tenant_id' => $tenant->id]);
                } catch (Throwable $e) {
                    Log::error('Sync failed for tenant, skipping', [
                        'tenant_id' => $tenant->id,
                        'message'   => $e->getMessage(),
                        'line'      => $e->getLine(),
                        'file'      => $e->getFile(),
                    ]);
                }
            }

            Log::info('Feature package sync completed successfully');
        } catch (Throwable $e) {
            Log::error('Feature package sync failed', [
                'message' => $e->getMessage(),
                'line'    => $e->getLine(),
                'file'    => $e->getFile(),
                'trace'   => $e->getTraceAsString(),
            ]);
        }
    }

    private function handleDeleteSync(Request $request): void
    {
        $deletedFeatureKey = $request->input('_deleted_feature_key');
        $deletedPackageId  = $request->input('_deleted_package_id');

        if (! $deletedFeatureKey || ! $deletedPackageId) {
            Log::error('DELETE sync failed: missing deleted feature data');
            return;
        }

        Log::info('DELETE sync started', [
            'feature_key' => $deletedFeatureKey,
            'package_id'  => $deletedPackageId,
        ]);

        $tenants = CentralTenant::whereHas('subscription', function ($query) use ($deletedPackageId) {
            $query->where('package_id', $deletedPackageId)
                ->where('active', true);
        })->get();

        Log::info('Tenants found', ['count' => $tenants->count()]);

        foreach ($tenants as $tenant) {

            Log::info('DELETE sync started for tenant', ['tenant_id' => $tenant->id]);

            try {
                $this->connectToTenant($tenant);

                DB::connection('tenant')
                    ->table('tenant_feature_usages')
                    ->where('feature_slug', $deletedFeatureKey)
                    ->delete();

                Log::info('DELETE sync completed for tenant', ['tenant_id' => $tenant->id]);
            } catch (Throwable $e) {
                Log::error('DELETE sync failed for tenant, skipping', [
                    'tenant_id' => $tenant->id,
                    'message'   => $e->getMessage(),
                    'line'      => $e->getLine(),
                    'file'      => $e->getFile(),
                ]);
            }
        }

        Log::info('Feature package delete sync completed successfully');
    }

    private function connectToTenant(object $tenant): void
    {
        Config::set('database.connections.tenant.driver',    'mysql');
        Config::set('database.connections.tenant.host',      $tenant->db_host);
        Config::set('database.connections.tenant.port',      3306);
        Config::set('database.connections.tenant.database',  $tenant->db_name);
        Config::set('database.connections.tenant.username',  $tenant->db_user);
        Config::set('database.connections.tenant.password',  $tenant->db_pass);
        Config::set('database.connections.tenant.charset',   'utf8mb4');
        Config::set('database.connections.tenant.collation', 'utf8mb4_unicode_ci');

        DB::purge('tenant');
        DB::reconnect('tenant');
    }

    private function syncTenantFeatures(\Illuminate\Support\Collection $featuresMap, array $currentKeys): void
    {
        foreach ($featuresMap as $slug => $data) {

            $exists = DB::connection('tenant')
                ->table('tenant_feature_usages')
                ->where('feature_slug', $slug)
                ->exists();

            if ($exists) {
                DB::connection('tenant')
                    ->table('tenant_feature_usages')
                    ->where('feature_slug', $slug)
                    ->update([
                        'total_limit' => $data['total_limit'],
                        'type'        => $data['type'],
                        'is_enabled'  => $data['is_enabled'],
                        'updated_at'  => now(),
                    ]);
            } else {
                DB::connection('tenant')
                    ->table('tenant_feature_usages')
                    ->insert([
                        'feature_slug' => $slug,
                        'total_limit'  => $data['total_limit'],
                        'used_amount'  => 0,
                        'type'         => $data['type'],
                        'is_enabled'   => $data['is_enabled'],
                        'status'       => true,
                        'created_at'   => now(),
                        'updated_at'   => now(),
                    ]);
            }
        }

        DB::connection('tenant')
            ->table('tenant_feature_usages')
            ->whereNotIn('feature_slug', $currentKeys)
            ->delete();
    }

    private function shouldSync(Request $request, Response $response): bool
    {
        return in_array($request->method(), ['POST', 'PUT', 'PATCH', 'DELETE'])
            && str_contains($request->path(), 'feature_packages')
            && $response->isSuccessful();
    }
}
