<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SectionsAndThreadsToRead extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('readed_threads', function(Blueprint $table){
            $table->bigIncrements("id");
            $table->bigInteger("user_id")->nullable(false)->references("id")->on("users");
            $table->bigInteger("thread_id")->nullable(false)->references("id")->on("threads");
            $table->boolean("is_read")->nullable(false)->default(false);
            $table->unique(["user_id", "thread_id"]);
            $table->unique(["thread_id", "user_id"]);
        });

    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('readed_threads');
    }
}
