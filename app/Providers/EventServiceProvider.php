<?php

namespace App\Providers;



use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Stancl\Tenancy\Events\TenantCreated;
use Stancl\Tenancy\Events\TenantDeleted;
use App\Listeners\ProvisionTenantDatabase;
use App\Listeners\DropTenantDatabase;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        TenantCreated::class => [
            ProvisionTenantDatabase::class,
        ],
        // Optional:
        TenantDeleted::class => [
            DropTenantDatabase::class,
        ],
    ];

    
}
