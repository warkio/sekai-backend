<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Shops extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Shops owners
        Schema::create("shopkeepers", function(Blueprint $table){
            $table->bigIncrements("id");
            $table->text("name")->nullable(false);
            $table->text("image");
            $table->text("backstory");
            $table->timestamps();
        });

        // Shops entities
        Schema::create("shops", function(Blueprint $table){
            $table->bigIncrements("id");
            $table->text("name");
            $table->text("background_image");
            $table->text("description");
            $table->timestamps();
        });

        // Shop items
        Schema::create("shop_items", function (Blueprint $table){
            $table->bigIncrements("id");
            $table->bigInteger("shop_id")->nullable(false);
            $table->bigInteger("item_id")->nullable(false);

            $table->foreign("shop_id")->references("id")->on("shops")->onDelete("cascade");
            $table->foreign("item_id")->references("id")->on("items")->onDelete("cascade");

            $table->unique(["shop_id", "item_id"]);
        });

        // Shop owners
        Schema::create("shop_owners", function (Blueprint $table){
            $table->bigIncrements("id");
            $table->bigInteger("shop_id")->nullable(false);
            $table->bigInteger("owner_id")->nullable(false);

            $table->foreign("shop_id")->references("id")->on("shops")->onDelete("cascade");
            $table->foreign("owner_id")->references("id")->on("shopkeepers")->onDelete("cascade");

            $table->unique("shop_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("shopkeepers");
        Schema::dropIfExists("shops");
        Schema::dropIfExists("shop_items");
        Schema::dropIfExists("shop_owners");
    }
}
