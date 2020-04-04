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
            ->set('data', $this->getData()) // custom claim
            ->sign(new Sha256(), new Key($privateKey->getKeyPath(), $privateKey->getPassPhrase()))
            ->getToken();
    }

    // custom claim for data
    public function getData() {
        # Save the scopes as collection once to avoid several convertions
        $scopes = collect($this->getScopes());

        $scopes->transform(function ($item, $key) {
            return $item->getIdentifier();
        });

        # Declare the data wrapper
        $data = collect([]);

        # Put information into the wrapper
        ## Put current-card data if user_card scope authorized
        if ( $scopes->flip()->has('user_card') ) {
            $data = $data->merge(CardsController::GetCurrentCard());
        }

        ## Put minimal profile data when profile scope authorized

        # Retrieve the wrapper
        return $data->toArray();
    }
}