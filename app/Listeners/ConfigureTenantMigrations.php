<?php

namespace App\Listeners;

use Illuminate\Support\Str;
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

        return;

        //        $this->order = array_unique(app('config')['hris-saas.database.migrations.order']);

        $paths = app('migrator')->paths();

        dd($paths);

        //        foreach ($paths as $path) {
        //            $path .= DIRECTORY_SEPARATOR . 'tenant';
        //
        //            $order = array_flip($this->order);
        //
        //            foreach ($order as $key => $value) {
        //                if (Str::contains($path, $key)) {
        //                    $this->finalPaths[$value] = realpath($path);
        //                }
        //            }
        //        }

        ksort($this->finalPaths);

        foreach ($this->finalPaths as $path) {
            $event->path($path);
        }
    }
}
