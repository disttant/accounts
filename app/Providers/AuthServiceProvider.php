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

        # Defining the scopes for OAuth
        Passport::tokensCan([
            'adaptative_r' => 'Can read information from Adaptative service',
            'adaptative_w' => 'Can add information to Adaptative service',
            'adaptative_d' => 'Can delete information from Adaptative service',
        ]);

        //Passport::ignoreCsrfToken(true);

        # Enabling implicit grant flow
        Passport::enableImplicitGrant();

        # Registering the routes for OAuth
        Passport::routes();

        # Setting life time for tokens
        Passport::tokensExpireIn(now()->addDays(1));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));

        

    }
}
