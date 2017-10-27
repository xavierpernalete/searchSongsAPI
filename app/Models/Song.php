<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Song extends Model
{

    use SoftDeletes;

    public $table = 'songs';
    public $timestamps = true;
    public static $snakeAttributes = false;

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'id',
        'url',
        'idspotify',
        'songname',
        'artistid',
        'artistname',
        'albumid',
        'albumname',

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'         => 'integer',
        'url'        => 'string',
        'idspotify'  => 'string',
        'songname'   => 'string',
        'artistid'   => 'string',
        'artistname' => 'float',
        'albumid'    => 'string',
        'albumname'  => 'string',
    ];
}
