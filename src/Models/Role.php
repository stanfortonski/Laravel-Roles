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
}
