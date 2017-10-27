<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionsSpotify extends Model
{
    protected $table = "sessions_spotify";
    public $timestamps = true;
    public static $snakeAttributes = false;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $dates = ['deleted_at'];


    public $fillable = [
        'code',
        'state',
        'type',
    ];
}
