<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ShopifyWebhookController extends Controller
{
    protected function connectTenant(string $tenant_name): bool
    {
        $tenant = DB::connection('xshop_central')
            ->table('tenants')
            ->where('domain', $tenant_name)
            ->where('active', 1)
            ->first();

        if (!$tenant) {
            Log::warning('Shopify webhook: tenant not found', ['tenant_name' => $tenant_name]);
            return false;
        }

        Config::set('database.connections.tenant.host',     $tenant->db_host);
        Config::set('database.connections.tenant.database', $tenant->db_name);
        Config::set('database.connections.tenant.username', $tenant->db_user);
        Config::set('database.connections.tenant.password', $tenant->db_pass);

        DB::purge('tenant');
        DB::reconnect('tenant');
        Config::set('database.default', 'tenant');

        return true;
    }

    public function handleProductCreate(Request $request, string $tenant_name)
    {
        Log::info('Shopify webhook: product create received', ['tenant_name' => $tenant_name]);

        if (!$this->connectTenant($tenant_name)) {
            return response()->json(['message' => 'Tenant not found'], 200);
        }

        $data    = $request->json()->all();
        $variant = $data['variants'][0] ?? [];

        if (DB::table('products')->where('shopify_product_id', $data['id'])->exists()) {
            return response()->json(['message' => 'Already exists'], 200);
        }

        try {
            DB::table('products')->insert([
                'name'                  => $data['title'],
                'description'           => $data['body_html']    ?? null,
                'sku'                   => $variant['sku']        ?? null,
                'barcode'               => $variant['barcode']    ?? null,
                'selling_price_inc_tax' => $variant['price']      ?? null,
                'weight'                => $variant['weight']     ?? null,
                'shopify_product_id'    => $data['id'],
                'product_type'          => $data['product_type']  ?? 'single',
                'not_for_sale'          => ($data['status'] ?? 'active') === 'draft' ? 1 : 0,
                'image'                 => $data['image']['src']  ?? null,
                'created_at'            => now(),
                'updated_at'            => now(),
            ]);

            Log::info('Shopify webhook: product created', ['shopify_id' => $data['id']]);
        } catch (\Exception $e) {
            Log::error('Shopify webhook: product create failed', ['error' => $e->getMessage()]);
        }

        return response()->json(['message' => 'OK'], 200);
    }

    public function handleProductUpdate(Request $request, string $tenant_name)
    {
        Log::info('Shopify webhook: product update received', ['tenant_name' => $tenant_name]);

        if (!$this->connectTenant($tenant_name)) {
            return response()->json(['message' => 'Tenant not found'], 200);
        }

        $data    = $request->json()->all();
        $variant = $data['variants'][0] ?? [];

        $exists = DB::table('products')->where('shopify_product_id', $data['id'])->exists();

        try {
            if (!$exists) {
                // لو المنتج مش موجود أصلاً عندنا، نعمله create
                DB::table('products')->insert([
                    'name'                  => $data['title'],
                    'description'           => $data['body_html']    ?? null,
                    'sku'                   => $variant['sku']        ?? null,
                    'barcode'               => $variant['barcode']    ?? null,
                    'selling_price_inc_tax' => $variant['price']      ?? null,
                    'weight'                => $variant['weight']     ?? null,
                    'shopify_product_id'    => $data['id'],
                    'product_type'          => $data['product_type']  ?? 'single',
                    'not_for_sale'          => ($data['status'] ?? 'active') === 'draft' ? 1 : 0,
                    'image'                 => $data['image']['src']  ?? null,
                    'created_at'            => now(),
                    'updated_at'            => now(),
                ]);
            } else {
                DB::table('products')
                    ->where('shopify_product_id', $data['id'])
                    ->update([
                        'name'                  => $data['title'],
                        'description'           => $data['body_html']    ?? null,
                        'sku'                   => $variant['sku']        ?? null,
                        'barcode'               => $variant['barcode']    ?? null,
                        'selling_price_inc_tax' => $variant['price']      ?? null,
                        'weight'                => $variant['weight']     ?? null,
                        'product_type'          => $data['product_type']  ?? 'single',
                        'not_for_sale'          => ($data['status'] ?? 'active') === 'draft' ? 1 : 0,
                        'image'                 => $data['image']['src']  ?? null,
                        'updated_at'            => now(),
                    ]);
            }

            Log::info('Shopify webhook: product updated', ['shopify_id' => $data['id']]);
        } catch (\Exception $e) {
            Log::error('Shopify webhook: product update failed', ['error' => $e->getMessage()]);
        }

        return response()->json(['message' => 'OK'], 200);
    }

    public function handleProductDelete(Request $request, string $tenant_name)
    {
        Log::info('Shopify webhook: product delete received', ['tenant_name' => $tenant_name]);

        if (!$this->connectTenant($tenant_name)) {
            return response()->json(['message' => 'Tenant not found'], 200);
        }

        $data = $request->json()->all();
        $shopifyId = $data['id'] ?? null;

        if (!$shopifyId) {
            return response()->json(['message' => 'No ID provided'], 200);
        }

        try {
            DB::table('products')
                ->where('shopify_product_id', $shopifyId)
                ->delete();

            Log::info('Shopify webhook: product deleted', ['shopify_id' => $shopifyId]);
        } catch (\Exception $e) {
            Log::error('Shopify webhook: product delete failed', ['error' => $e->getMessage()]);
        }

        return response()->json(['message' => 'OK'], 200);
    }
}
