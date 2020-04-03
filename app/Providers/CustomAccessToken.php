<?php

namespace App\Providers;

use Laravel\Passport\Bridge\AccessToken as PassportAccessToken;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use League\OAuth2\Server\CryptKey;
use App\Http\Controllers\CardsController;

class CustomAccessToken extends PassportAccessToken {
    public function convertToJWT(CryptKey $privateKey)
    {
        return (new Builder())
            ->setAudience($this->getClient()->getIdentifier())
            ->setId($this->getIdentifier(), true)
            ->setIssuedAt(time())
            ->setNotBefore(time())
            ->setExpiration($this->getExpiryDateTime()->getTimestamp())
            ->setSubject($this->getUserIdentifier())
            ->set('scopes', $this->getScopes())
            ->set('data', $this->getData()) // my custom claims
            ->sign(new Sha256(), new Key($privateKey->getKeyPath(), $privateKey->getPassPhrase()))
            ->getToken();
    }

    // my custom claims for roles
    // Just an example. 
    public function getData() {
        # Save the scopes once to avoid continuos execution
        $scopes = $this->getScopes();

        # Declare the data wrapper
        $data = [];

        # Put information into the wrapper
        ## Put current card data if user_card scope authorized
        if (array_key_exists('user_card', $scopes)) {
            array_push ($data, CardsController::GetCurrentCard());
        }

        # Retrieve the wrapper
        return $data;
    }
}