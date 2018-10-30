<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Useritems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("user_items", function (Blueprint $table){
            $table->increments("id");
            $table->bigInteger("user_id")->nullable(false);
            $table->bigInteger("item_id")->nullable(false);
            $table->foreign("item_id")->references("id")->on("items")->onDelete("cascade");
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("user_items");
    }
}
