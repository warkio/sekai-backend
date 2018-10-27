<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RolesPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("role_permissions", function(Blueprint $table){
            $table->bigIncrements("id");
            $table->bigInteger("role_id")->nullable(false);
            $table->bigInteger("permission_id")->nullable(false);
            $table->foreign("role_id")->references("id")->on("roles")->onDelete("cascade");
            $table->foreign("permission_id")->references("id")->on("permissions")->onDelete("cascade");
            $table->timestamps();

            $table->unique(["role_id", "permission_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("role_permissions");
    }
}
