<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserItem extends Model
{
    protected $table = "user_items";
    public $fillable = ["user_id", "item_id"];
}
