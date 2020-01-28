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
     *  List all available devices of the given user
     *
     * */
    /*public static function List(string $user_id = null)
    {
        if ( is_null($user_id) || empty($user_id) )
            return [];

        return Device::select('name', 'type', 'description')
            ->where('user_id', $user_id)
            ->get();
    }*/



    /* *
     *
     *  List all not related devices of the given user
     *
     * */
    /*public static function Free(string $user_id = null)
    {
        if ( is_null($user_id) || empty($user_id) )
            return [];

        return Device::select('name', 'type', 'description')
            ->where('user_id', $user_id)
            ->whereNotIn('id', 
                Relation::select('device_id')
                    ->whereColumn('device_id', 'devices.id')
                    ->where('user_id', $user_id)
            )
            ->get();
    }*/



    /* *
     *
     * Creates a new developer in the system
     * 
     * @return  false (if the user could not be created)
     *          null (if the user already exists)
     *          int (new row ID, if the user was created)
     *
     * */
    public static function Create(int $user_id, string $name, string $document, string $email, string $phone, string $summary)
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
    public static function GetProfile(int $id )
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
    public static function RemoveOne(int $id )
    {
        if ( is_null($id) || empty($id) )
            return false;

        $deletion = self::where('id', $id)->delete();

        if ( $deletion == false ){
            return false;
        }

        return true;
    }



    /* *
     *
     *  Deletes a device from the given user
     *
     * */
    /*public static function Remove(string $user_id = null, string $name = null)
    {
        if ( is_null($user_id) || empty($user_id) )
            return false;

        if ( is_null($name) || empty($name) )
            return false;

        $deletedRows = Device::where('user_id', $user_id)->where('name', $name);
        $deletedRows->delete();

        return true;

    }*/



    /* *
     *
     *  Set new value for device
     *
     * */
    /*public static function Change( string $user_id = null, string $device = null, array $changes = [])
    {

        if ( is_null($user_id) || empty($user_id) )
            return false;

        if ( is_null($device) || empty($device) )
            return false;

        if ( is_null($changes) || empty($changes) )
            return false;

        # Try to update that device
        $updateDevice = Device::where('user_id', $user_id)
            ->where('name', $device)
            ->update($changes);

        if ( $updateDevice == false )
            return null;

        return true;
    }*/



    /* *
     *
     * Retrieves N messages for a given user-device pair
     *
     * */

    /*public static function GetMessages(string $user_id = null, string $device = null, $limit = 1)
    {
        if ( is_null($user_id) || empty($user_id) )
            return [];

        if ( is_null($device) || empty($device) )
            return [];

        return Message::select('messages.message', 'messages.created_at')

            ->join('devices', 'devices.id', '=', 'messages.device_id')
                ->where('devices.user_id', $user_id)
                ->where('devices.name', $device)

            ->where('messages.user_id', $user_id)
            ->orderBy('messages.id', 'desc')
            ->limit($limit, 10)
            ->get();

    }*/



    /* *
     *
     *  Creates a new message for the given user-device pair
     *
     * */
    /*public static function SetMessage(string $user_id = null, string $device = null, string $message = null)
    {
        if ( is_null($user_id) || empty($user_id) )
            return false;

        if ( is_null($device) || empty($device) )
            return false;

        if ( is_null($message) || empty($message) )
            return false;

        # Get the device_id of a device name
        $device_id = Device::where('name', $device)
            ->where('user_id', $user_id)
            ->first();

        if ( is_null( $device_id ) )
            return false;
        
        $device_id = $device_id->id;
        
        # Create a new message
        $newMessage = new Message;

        $newMessage->user_id = $user_id;
        $newMessage->device_id = $device_id;
        $newMessage->message = $message;

        if ( $newMessage->save() === false )
            return false;

        return true;
    }*/



}
