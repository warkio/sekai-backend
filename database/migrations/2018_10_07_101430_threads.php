<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Threads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("threads", function(Blueprint $table){
           $table->bigIncrements("id");
           $table->string("name")->nullable(false);
           $table->string("slug")->nullable(false);
           $table->string("description")->nullable(true);
           $table->bigInteger("user_id")->nullable(false);
           $table->bigInteger("section_id")->nullable(false);
           $table->boolean("is_pinned")->default(false);
           $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
           $table->foreign("section_id")->references("id")->on("sections")->onDelete("cascade");
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
        Schema::dropIfExists("threads");
    }
}
