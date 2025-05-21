<?php

namespace App\Jobs;

use App\Models\User;
use App\Eloquent\Tenant;
use Tenancy\Facades\Tenancy;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateTenant implements ShouldQueue
{
    use Queueable;

    /**
     * The data to create the tenant.
     *
     * @var array
     */
    protected array $data;

    /**
     * The tenant instance.
     *
     * @var Tenant
     */
    protected Tenant $tenant;

    /**
     * Create a new job instance.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): Tenant
    {
        $this->tenant = Tenant::create($this->data);

        $user = $this->registerAdmin();

        return $this->tenant;
    }

    private function registerAdmin()
    {
        // TODO: Implement registerAdmin() method.
        Tenancy::setTenant($this->tenant);

        $user = User::create($this->data);
    }
}
