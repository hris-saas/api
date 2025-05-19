<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Listeners\ConfigureApplicationUrl;
use App\Listeners\ResolveTenantConnection;
use App\Listeners\ConfigureTenantConnection;
use App\Listeners\ConfigureTenantMigrations;
use Tenancy\Affects\URLs\Events\ConfigureURL;
use App\Listeners\ConfigureTenantIntegrations;
use Tenancy\Affects\Configs\Events\ConfigureConfig;
use Tenancy\Affects\Connections\ConfiguresConnection;
use Tenancy\Hooks\Migration\Events\ConfigureMigrations;
use Tenancy\Affects\Connections\Events\Resolving as ResolvingConnection;

class EventServiceProvider extends ServiceProvider
{
    protected array $listen = [
        ConfigureMigrations::class => [
            ConfigureTenantMigrations::class,
        ],

        ConfiguresConnection::class => [
            ConfigureTenantConnection::class,
        ],

        ResolvingConnection::class => [
            ResolveTenantConnection::class,
        ],

        ConfigureConfig::class => [
            ConfigureTenantIntegrations::class,
        ],

        ConfigureURL::class => [
            ConfigureApplicationUrl::class,
        ],
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
