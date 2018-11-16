<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = "user_roles";
    protected $fillable = [
        "role_id", "user_id"
    ];
}
