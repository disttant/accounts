<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OauthRefreshToken extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'oauth_refresh_tokens';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'access_token_id',
        'revoked'
    ];

    


}
