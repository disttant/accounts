<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comodito extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'user_id',
        'key',
    ];



}