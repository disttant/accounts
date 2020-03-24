<?php

namespace App\Providers;


class CustomAccessTokenRepository extends \Laravel\Passport\Bridge\AccessTokenRepository
{
     /**
     * {@inheritdoc}
     */
    public function getNewToken(ClientEntityInterface $clientEntity, array $scopes, $userIdentifier = null)
    {
        return new CustomAccessToken($userIdentifier, $scopes);
    }
 
}