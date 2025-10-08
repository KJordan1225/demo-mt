<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Artisan;
use Stancl\Tenancy\Events\TenantCreated;
use Stancl\Tenancy\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;


class ProvisionTenantDatabase
{
    public function __construct(
        protected DatabaseManager $db
    ) {}

    public function handle(TenantCreated $event): void
    {
        $tenant = $event->tenant;
        $dbName = 'tenant_' . $tenant->getKey();

        // 1) Create a physical DB for this tenant (multi-database mode)
        // DatabaseManager figures out the DB name using your config/tenant data.
        DB::statement("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

        // (Optional) persist the name if you want to read it later
        // $tenant->put('database', $dbName);
        $tenant->update(['database' => $dbName]);
        $tenant->save();

        // 2) Run tenant migrations (the ones you keep in database/migrations/tenant)
        // Run "inside" the tenant so UsesTenantConnection & config switching work.
        Artisan::call('tenants:artisan', [
            'artisanCommand' => 'migrate --force --path=database/migrations/tenant',
            '--tenants'      => [$tenant->getKey()],
        ]);

    }
}
