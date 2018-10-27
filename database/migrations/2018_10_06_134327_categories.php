<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Categories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("categories", function(Blueprint $table){
            $table->bigIncrements("id");
            $table->string("name")->nullable(false)->unique(true);
            $table->string("slug")->nullable(false);
            $table->string("description")->nullable(true);
            $table->string("image")->nullable(true);
            $table->string("color")->nullable(false)->default("#ffffff");
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
        Schema::dropIfExists("categories");
    }
}
