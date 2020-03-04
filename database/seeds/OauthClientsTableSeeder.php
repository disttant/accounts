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
        # Remember that clients have to be generated in the same way Passport does it 
        # To generate a $client->secret you must use Str::random(40);



        # Generate a client for the official webapp
        $client                               = new OauthClient();
        $client->user_id                      = '1';
        $client->name                         = 'Adaptative Webapp';
        $client->secret                       = 'FC6Ft3IAZSKVjuBvSnrDc5fHkoMSalGRNe6j9qzc';
        $client->redirect                     = 'http://adaptative.alke.systems/?g=gimme';
        $client->personal_access_client       = false;
        $client->password_client              = false;
        $client->revoked                      = false;
        $client->save();



        # Generate a client for the official device: Adaptative Light One
        $client                               = new OauthClient();
        $client->user_id                      = '1';
        $client->name                         = 'Adaptative Light One';
        $client->secret                       = 'uGuiWmwXEah1gjjvJQj5QJ2Lk1sc3WzvgkWlrwcE';
        $client->redirect                     = 'http://adaptative.alke.systems/?g=gimme';
        $client->personal_access_client       = false;
        $client->password_client              = true;
        $client->revoked                      = false;
        $client->save();



        # Generate a client for the official device: Adaptative Socket One
        $client                               = new OauthClient();
        $client->user_id                      = '1';
        $client->name                         = 'Adaptative Socket One';
        $client->secret                       = 'GtrenVcDvqejPn3wGT9Pum9rwFycWB0JRG6H6V8Y';
        $client->redirect                     = 'http://adaptative.alke.systems/?g=gimme';
        $client->personal_access_client       = false;
        $client->password_client              = true;
        $client->revoked                      = false;
        $client->save();

    }
}
