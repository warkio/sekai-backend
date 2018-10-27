<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class PermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("permissions", function(Blueprint $table){
            $table->bigIncrements("id");
            $table->text("name");
            $table->timestamps();
        });

        // Default permissions
        DB::table("permissions")->insert(
            [
                [
                    "name"=>"admin"
                ],
                [
                    "name"=>"admin panel"
                ],
                // Threads
                [
                    "name"=>"create thread"
                ],
                [
                    "name"=>"delete thread"
                ],
                [
                    "name"=>"edit thread"
                ],
                // Categories
                [
                    "name"=>"create categories"
                ],
                [
                    "name"=>"delete categories"
                ],
                [
                    "name"=>"edit categories"
                ],
                // Sections
                [
                    "name"=>"create sections"
                ],
                [
                    "name"=>"edit sections"
                ],
                [
                    "name"=>"delete sections"
                ],
                // Posts
                [
                    "name"=>"create posts"
                ],
                [
                    "name"=>"edit posts"
                ],
                [
                    "name"=>"delete posts"
                ],
                // users
                [
                    "name"=>"manage users"
                ],
                // Roles
                [
                    "name"=>"manage roles"
                ],
                // Permissions
                [
                    "name"=>"manage permissions"
                ],
                // Items
                [
                    "name"=>"create items"
                ],
                [
                    "name"=>"delete items"
                ],
                [
                    "name"=>"assign items"
                ],
                // Shops
                [
                    "name"=>"create shops"
                ],
                [
                    "name"=>"delete shops"
                ],
                [
                    "name"=>"edit shops"
                ]
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("permissions");
    }
}
