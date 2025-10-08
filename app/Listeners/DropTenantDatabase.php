<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Stancl\Tenancy\Events\TenantDeleted;
use Stancl\Tenancy\Database\DatabaseManager;

class DropTenantDatabase
{
    public function __construct(
        protected DatabaseManager $db
    ) {}

    public function handle(TenantDeleted $event): void
    {
        $this->db->deleteDatabase($event->tenant);
    }
}
