<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Items extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("items", function(Blueprint $table){
            $table->bigIncrements("id");
            $table->text("name")->nullable(false);
            $table->text("description")->nullable(true);
            $table->text("image")->nullable(true);
            $table->integer("buy_price")->default(0)->nullable(false);
            $table->integer("sell_price")->default(0)->nullable(false);
            $table->boolean("on_rol_item")->default(false)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("items");
    }
}
