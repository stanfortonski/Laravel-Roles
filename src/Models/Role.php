<?php

namespace Stanfortonski\Laravelroles\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'role_id'
    ];

    static public function findByName(string $name)
    {
        return static::where('name', '=', $name)->first();
    }

    static public function findOrFailByName(string $name)
    {
        return static::where('name', '=', $name)->firstOrFail();
    }
}
