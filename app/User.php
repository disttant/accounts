<?php

namespace App;

use App\Role as Role;
use App\RoleUser as RoleUser;

use App\Notifications\CustomResetPassword;
use App\Notifications\CustomVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;



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
     * @param  string  $token
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail);
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
}
