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

    public function users(){
        return $this->belongsToMany('App\User', 'users_roles', 'role_id', 'user_id');
    }
}
