<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("sections", function(Blueprint $table){
            $table->bigIncrements("id");
            $table->string("image")->nullable(true);
            $table->string("color")->default("#ffffff");
            $table->string("name")->nullable(false);
            $table->string("slug")->nullable(false);
            $table->string("description")->nullable(true);
            $table->bigInteger("category_id")->nullable(false);
            $table->foreign("category_id")->references("id")->on("categories")->onDelete("cascade");
            $table->timestamps();

            $table->unique(["category_id", "name"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("sections");
    }
}
