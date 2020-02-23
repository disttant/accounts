<?php

use App\OauthClient;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OauthClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $client                               = new OauthClient();
        $client->user_id                      = '1';
        $client->name                         = 'Adaptative!';
        # $client->secret                       = Str::random(40); GENERATE A RANDOM STRING HOW PASSPORT DOES
        $client->secret                       = 'FC6Ft3IAZSKVjuBvSnrDc5fHkoMSalGRNe6j9qzc';
        $client->redirect                     = 'http://adaptative.alke.systems/?g=gimme';
        $client->personal_access_client       = false;
        $client->password_client              = false;
        $client->revoked                      = false;
        $client->save();

    }
}
