<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        # Definition of scopes
        Passport::tokensCan([
            'broker_r' => 'Can read information from Broker service',
            'broker_w' => 'Can add information to Broker service',
            'broker_d' => 'Can delete information from Broker service',
        ]);

        Passport::routes();

    }
}
