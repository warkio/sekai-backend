<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Posts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("posts", function(Blueprint $table){
           $table->bigIncrements("id");
           $table->text("content")->nullable(false);
           $table->bigInteger("last_updated_by")->nullable(true);
           $table->string("last_update_reason")->nullable(true);
           $table->bigInteger("user_id")->nullable(false);
           $table->bigInteger("thread_id")->nullable(false);

           $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
           $table->foreign("thread_id")->references("id")->on("threads")->onDelete("cascade");
           $table->foreign("last_updated_by")->references("id")->on("users");
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
        Schema::dropIfExists("posts");
    }
}
