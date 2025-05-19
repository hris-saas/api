<?php

namespace App\Console\Commands;

use App\Jobs\CreateTenant;
use Illuminate\Console\Command;
use App\Generators\UuidGenerator;

class CreateTenantCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenancy:create-tenant {tenant}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new tenant.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tenant = $this->argument('tenant') === 'test' ? 'test' : $this->argument('tenant');

        $domain = config('app.domain');

        $url = $tenant . '.' . $domain;

        $password = bcrypt('password');

        $data = [
            'uuid' => $tenant === 'test' ? '9669ed7' : (new UuidGenerator())->generate(),
            'is_test' => $tenant === 'test',
            'fqdn' => $url,
            'first_name ' => ucfirst($tenant),
            'last_name' => 'Admin',
            'email' => "$tenant@$domain",
            'password' => $password,
            'password_confirmation' => $password,
            'name' => ucfirst($tenant),
        ];

        $tenant = (new CreateTenant($data))->handle();
    }
}
