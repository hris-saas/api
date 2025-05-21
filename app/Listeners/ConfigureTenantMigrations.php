<?php

namespace App\Listeners;

use Tenancy\Tenant\Events\Deleted;
use Tenancy\Hooks\Migration\Events\ConfigureMigrations;

class ConfigureTenantMigrations
{
    protected array $order = [];

    protected array $finalPaths = [];

    public function handle(ConfigureMigrations $event)
    {
        if ($event->event instanceof Deleted) {
            $event->disable();
        }

        $event->path(database_path('tenant/migrations'));
    }
}
