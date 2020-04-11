<?php

namespace App;

use App\Role as Role;
use App\RoleUser as RoleUser;
//use App\OauthClient as OauthClient;
//use App\OauthAccessToken as OauthAccessToken;
//use App\OauthRefreshToken as OauthRefreshToken;

use App\Notifications\CustomResetPassword;
use App\Notifications\CustomVerifyEmail;
use App\Notifications\DeveloperApplicacionResult;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

use Illuminate\Support\Facades\DB;



class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPassword($token));
    }



    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail);
    }



    /**
     * Send the notification about the developer applicacion result.
     *
     * @return void
     */
    public function sendDeveloperApplicacionResultNotification( $result, $message )
    {
        $this->notify(new DeveloperApplicacionResult( $result, $message ) );
    }



    /* *
     *
     *
     * 
     */     
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }



    /* *
     *
     * 
     * 
     */
    public function authorizeRoles( $roles )
    {
        abort_unless($this->hasAnyRole($roles), 401);
        return true;
    }



    /* *
     *
     * 
     * 
     */
    public function hasAnyRole( $roles )
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true; 
            }   
        }
        return false;
    }
    


    /* *
     *
     * 
     * 
     */
    public function hasRole( $role )
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }



    /* *
     *
     *  Retrieves a user profile
     *
     * */
    public static function GetProfile( int $id )
    {
        if ( is_null($id) || empty($id) )
            return [];

        return self::where('id', $id )->first();

    }



    /* *
     *
     *  Set a role for the given user ID
     *
     * */
    public static function SetRole( string $role, int $id )
    {
        if ( is_null($role) || empty($role) )
            return false;

        if ( is_null($id) || empty($id) )
            return false;

        # Check if the user exists into the system
        $user = self::where('id', $id)->first();
        if( is_null($user) ){
            return false;
        }

        # Check if the role exists into the system
        $role = Role::where('name', $role)->first();
        if( is_null($role) ){
            return false;
        }

        # Try to set the role for the user
        $roleUser = RoleUser::firstOrNew([
            
            'role_id' => $role->id, 
            'user_id' => $user->id
            
        ]);

        if ( $roleUser->exists === true )
            return null;

        if ( $roleUser->save() === false )
            return false;

        return true;

    }



    /* *
     *
     *  Get a list of authorized oauth clients
     * 
     * For security reasons we will look for clients permissions in 3 tables
     * and then intersect the results to avoid the failure chance
     *
     * */
    public static function getAuthorizedClients( int $userId )
    {
        # Get OAuth clients with allowed Auth Codes for this user
        $oauthAuthCodes = DB::table('oauth_auth_codes')
                    ->leftJoin('oauth_clients', 'oauth_auth_codes.client_id', '=', 'oauth_clients.id')
                    ->where('oauth_auth_codes.user_id' , $userId)
                    ->where('oauth_auth_codes.revoked' , false)
                    ->where('oauth_clients.revoked' , false)
                    ->select('oauth_clients.id', 'oauth_clients.name')
                    ->groupBy('oauth_clients.id')
                    ->orderBy('oauth_clients.name')
                    ->get();

        # Get OAuth clients with allowed Access Tokens for this user
        $oauthAccessTokens = DB::table('oauth_access_tokens')
                    ->leftJoin('oauth_clients', 'oauth_access_tokens.client_id', '=', 'oauth_clients.id')
                    ->where('oauth_access_tokens.user_id' , $userId)
                    ->where('oauth_access_tokens.revoked' , false)
                    ->where('oauth_clients.revoked' , false)
                    ->select('oauth_clients.id', 'oauth_clients.name')
                    ->groupBy('oauth_clients.id')
                    ->orderBy('oauth_clients.name')
                    ->get();
        
        # Get OAuth clients with allowed Refresh Tokens for this user
        $oauthRefreshTokens = DB::table('oauth_access_tokens')
                    ->leftJoin('oauth_refresh_tokens', 'oauth_refresh_tokens.access_token_id', '=', 'oauth_access_tokens.id')
                    ->leftJoin('oauth_clients', 'oauth_access_tokens.client_id', '=', 'oauth_clients.id')
                    ->where('oauth_access_tokens.user_id' , $userId)
                    ->where('oauth_refresh_tokens.revoked' , false)
                    ->select('oauth_clients.id', 'oauth_clients.name')
                    ->groupBy('oauth_clients.id')
                    ->orderBy('oauth_clients.name')
                    ->get();

        # Calculate intersection between them to return just 1 array filtered
        $clients = collect([]);
        $clients = $clients->merge($oauthAuthCodes);
        $clients = $clients->merge($oauthAccessTokens);
        $clients = $clients->merge($oauthRefreshTokens);
        $clients = $clients->unique();

        return $clients;
    }



    /* *
     *
     *  Get a list of authorized oauth clients paginated
     * 
     *
     * */
    public static function getAuthorizedClientsPaginated( int $userId, int $page = 1 )
    {
        # Get all authorized clients as a collection
        $clients = self::getAuthorizedClients( $userId );

        return $clients->paginate(1);
    }



    /* *
     *
     *  Update Oauth Auth Codes table, setting true 
     *  on 'revoked' column for a user and client
     * 
     * @return bool
     *
     * */
    public static function revokeAuthCodes( int $userId, int $clientId )
    {
        $revoked = DB::table('oauth_auth_codes')
                    ->where('user_id' , $userId)
                    ->where('client_id' , $clientId)
                    ->update(['revoked' => true]);

        if ( is_int($revoked) === false )
            return false;

        return true;
    }



    /* *
     *
     *  Update Oauth Access Tokens table, setting true 
     *  on 'revoked' column for a user and client
     * 
     * @return bool
     *
     * */
    public static function revokeAccessTokens( int $userId, int $clientId )
    {
        $revoked = DB::table('oauth_access_tokens')
                    ->where('user_id' , $userId)
                    ->where('client_id' , $clientId)
                    ->update(['revoked' => true]);

        if ( is_int($revoked) === false )
            return false;

        return true;
    }



    /* *
     *
     *  Update Oauth Refresh Tokens table, setting true 
     *  on 'revoked' column for a user and client
     * 
     * @return bool
     *
     * */
    public static function revokeRefreshTokens( int $userId, int $clientId )
    {
        $revoked = DB::table('oauth_access_tokens')
                    ->join('oauth_refresh_tokens', 'oauth_access_tokens.id', '=', 'oauth_refresh_tokens.access_token_id')
                    ->where('oauth_access_tokens.user_id' , $userId)
                    ->where('oauth_access_tokens.client_id' , $clientId)
                    ->update(['oauth_refresh_tokens.revoked' => true]);

        if ( is_int($revoked) === false )
            return false;

        return true;
    }





}
