<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OauthClient extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'oauth_clients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 
        'user_id',
        'name',
        'secret',
        'redirect',
        'personal_access_client',
        'password_client',
        'revoked'
    ];

    
}
