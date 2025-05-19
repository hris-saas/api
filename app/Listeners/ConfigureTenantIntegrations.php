<?php

namespace App\Listeners;

use Tenancy\Facades\Tenancy;
use Tenancy\Affects\Configs\Events\ConfigureConfig;

class ConfigureTenantIntegrations
{
    public function handle(ConfigureConfig $event)
    {
        if ($tenant = $event->event->tenant) {

            $url = request()->isSecure() ? 'https://' . $tenant->fqdn : 'http://' . $tenant->fqdn;
            $event->set('database.default', Tenancy::getTenantConnectionName());
            $event->set('app.url', $url);
        }
    }
}
