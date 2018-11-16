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
                    "name"=>"create categorie",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                [
                    "name"=>"delete categorie",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                [
                    "name"=>"edit categorie",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                // Sections
                [
                    "name"=>"create section",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                [
                    "name"=>"edit section",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                [
                    "name"=>"delete section",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                // Posts
                [
                    "name"=>"create post",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                [
                    "name"=>"edit post",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                [
                    "name"=>"delete post",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                // users
                [
                    "name"=>"manage user",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                // Roles
                [
                    "name"=>"manage role",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                // Permissions
                [
                    "name"=>"manage permission",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                // Items
                [
                    "name"=>"create item",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                [
                    "name"=>"delete item",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                [
                    "name"=>"assign item",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                // Shops
                [
                    "name"=>"create shop",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                [
                    "name"=>"delete shop",
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now()
                ],
                [
                    "name"=>"edit shop",
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
