<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("user_roles", function(Blueprint $table){
            $table->bigIncrements("id");
            $table->bigInteger("user_id")->nullable(false);
            $table->bigInteger("role_id")->nullable(false);
            $table->foreign("role_id")->references("id")->on("roles")->onDelete("cascade");
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->timestamps();

            $table->unique(["role_id", "user_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
