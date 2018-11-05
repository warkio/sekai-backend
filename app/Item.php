<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public $fillable = ["name", "description", "image", "buy_price", "sell_price", "on_rol_item"];
    protected $table = "items";
}
