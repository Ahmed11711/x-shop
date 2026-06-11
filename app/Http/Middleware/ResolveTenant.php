<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class ResolveTenant
{
    public function handle($request, Closure $next)
    {
        $host = $request->header('X-Tenant-Key')
            ?? $request->query('tenant')
            ?? $request->getHost();

        $tenant = cache()->remember("tenant_meta_{$host}", now()->addDay(), function () use ($host) {
            $row = DB::connection('xshop_central')
                ->table('tenants')
                ->where('domain', $host)
                ->where('active', 1)
                ->first();

            return $row ? (array) $row : null; // ← التغيير هنا
        });

        if (! $tenant) {
            cache()->forget("tenant_meta_{$host}");
            abort(403, 'Tenant not found or inactive.');
        }

        Config::set('database.connections.tenant.driver',   'mysql');
        Config::set('database.connections.tenant.host',     $tenant['db_host']);
        Config::set('database.connections.tenant.port',     3306);
        Config::set('database.connections.tenant.database', $tenant['db_name']);
        Config::set('database.connections.tenant.username', $tenant['db_user']);
        Config::set('database.connections.tenant.password', $tenant['db_pass']);
        Config::set('database.connections.tenant.search_path', 'public');
        Config::set('database.connections.tenant.sslmode',  'prefer');

        DB::purge('tenant');
        Config::set('database.default', 'tenant');
        DB::reconnect('tenant');

        app()->instance('tenant', (object) $tenant); // ← لو محتاج تستخدمه كـ object في أي مكان تاني

        return $next($request);
    }
}
