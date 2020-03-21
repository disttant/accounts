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
            'api_r' => __('Read information from service'),
            'api_w' => __('Publish information to service'),
            'api_d' => __('Delete information from service'),
        ]);

        //Passport::ignoreCsrfToken(true);

        # Enabling implicit grant flow
        Passport::enableImplicitGrant();

        # Registering the routes for OAuth
        Passport::routes();

        # Load OAuth keys from specific folder
        Passport::loadKeysFrom( base_path('keys') );

        # Setting life time for tokens
        Passport::tokensExpireIn(now()->addDays(1));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));

        

    }
}
