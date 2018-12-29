<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \Illuminate\Support\Facades\DB;

class Logs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("log_types", function(Blueprint $table){
            $table->increments("id");
            $table->text("name")->nullable(false)->unique();
            $table->timestamps();
        });
        DB::table("log_types")->insert(
            [
                [
                    "name"=>"user",
                    "created_at"=>\Carbon\Carbon::now(),
                    "updated_at"=>\Carbon\Carbon::now()
                ],
                [
                    "name"=>"category",
                    "created_at"=>\Carbon\Carbon::now(),
                    "updated_at"=>\Carbon\Carbon::now()
                ],
                [
                    "name"=>"section",
                    "created_at"=>\Carbon\Carbon::now(),
                    "updated_at"=>\Carbon\Carbon::now()
                ],
                [
                    "name"=>"thread",
                    "created_at"=>\Carbon\Carbon::now(),
                    "updated_at"=>\Carbon\Carbon::now()
                ],
                [
                    "name"=>"post",
                    "created_at"=>\Carbon\Carbon::now(),
                    "updated_at"=>\Carbon\Carbon::now()
                ],
                [
                    "name"=>"item",
                    "created_at"=>\Carbon\Carbon::now(),
                    "updated_at"=>\Carbon\Carbon::now()
                ],
                [
                    "name"=>"shop",
                    "created_at"=>\Carbon\Carbon::now(),
                    "updated_at"=>\Carbon\Carbon::now()
                ],
                [
                    "name"=>"shopkeeper",
                    "created_at"=>\Carbon\Carbon::now(),
                    "updated_at"=>\Carbon\Carbon::now()
                ]
            ]
        );
        Schema::create("logs", function(Blueprint $table){
            $table->bigIncrements("id");
            $table->text("log_type")->references("name")->on("log_types");
            $table->jsonb("details")->nullable(false);
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
        Schema::dropIfExists("logs");
        Schema::dropIfExists("log_types");
    }
}
