<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{

    protected $fillable = [
        'user_id',
        'name',
        'document',
        'email',
        'phone',
        'summary'
    ];



    /* *
     *
     * Creates a new developer in the system
     * 
     * @return  false (if the user could not be created)
     *          null (if the user already exists)
     *          int (new row ID, if the user was created)
     *
     * */
    public static function Create( int $user_id, string $name, string $document, string $email, string $phone, string $summary )
    {
        if ( is_null($user_id) || empty($user_id) )
            return false;

        if ( is_null($name) || empty($name) )
            return false;

        if ( is_null($document) || empty($document) )
            return false;

        if ( is_null($email) || empty($email) )
            return false;

        if ( is_null($phone) || empty($phone) )
            return false;

        if ( is_null($summary) || empty($summary) )
            return false;

        $developer = Developer::firstOrNew(
            
            [
                'user_id'    => $user_id
            ],

            [
                'user_id'    => $user_id,
                'name'       => $name,
                'document'   => $document,
                'email'      => $email,
                'phone'      => $phone,
                'summary'    => $summary,
            ]
        );

        if ( $developer->exists === true )
            return null;

        if ( $developer->save() === false )
            return false;

        # Return the ID of the new row
        return $developer->attributes['id'];

    }



    /* *
     *
     *  Retrieves a developer profile
     *
     * */
    public static function GetProfile( int $id )
    {
        if ( is_null($id) || empty($id) )
            return [];

        return self::where('id', $id)->first();

    }



    /* *
     *
     *  Remove a developer profile
     *
     * */
    public static function RemoveOne( int $id )
    {
        if ( is_null($id) || empty($id) )
            return false;

        $deletion = self::where('id', $id)->delete();

        if ( $deletion == false ){
            return false;
        }

        return true;
    }




}
