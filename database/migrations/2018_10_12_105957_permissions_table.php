<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
                    "name"=>"admin",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                [
                    "name"=>"admin panel",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                // Threads
                [
                    "name"=>"create thread",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                [
                    "name"=>"delete thread",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                [
                    "name"=>"edit thread",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                // Categories
                [
                    "name"=>"create categories",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                [
                    "name"=>"delete categories",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                [
                    "name"=>"edit categories",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                // Sections
                [
                    "name"=>"create sections",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                [
                    "name"=>"edit sections",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                [
                    "name"=>"delete sections",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                // Posts
                [
                    "name"=>"create posts",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                [
                    "name"=>"edit posts",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                [
                    "name"=>"delete posts",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                // users
                [
                    "name"=>"manage users",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                // Roles
                [
                    "name"=>"manage roles",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                // Permissions
                [
                    "name"=>"manage permissions",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                // Items
                [
                    "name"=>"create items",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                [
                    "name"=>"delete items",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                [
                    "name"=>"assign items",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                // Shops
                [
                    "name"=>"create shops",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                [
                    "name"=>"delete shops",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                [
                    "name"=>"edit shops",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
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
