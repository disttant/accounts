<?php

namespace App\Providers;

class CustomPassportServiceProvider extends \Laravel\Passport\PassportServiceProvider
{
 
    /**
     * Interviene la instanciación del servidor de autenticación para cambiar el repositorio de tokens JWT
     *
     * @return \League\OAuth2\Server\AuthorizationServer
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function makeAuthorizationServer()
    {
        return new AuthorizationServer(
            $this->app->make(ClientRepository::class),
            $this->app->make( \App\Auth\Bridge\CustomAccessTokenRepository::class),  // This!!
            $this->app->make(ScopeRepository::class),
            $this->makeCryptKey('private'),
            app('encrypter')->getKey()
        );
    }
}