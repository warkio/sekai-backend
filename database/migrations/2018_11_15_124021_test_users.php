<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \Illuminate\Support\Facades\DB;

// TODO - Delete this migration
class TestUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $userId = DB::table("users")->insertGetId([
            "name"=>"Test User",
            "email"=>"test_user@test.com",
            "password"=>\Illuminate\Support\Facades\Hash::make("test")
        ]);

        $adminId = DB::table("users")->insertGetId([
            "name"=>"Test Admin",
            "email"=>"test_admin@test.com",
            "password"=>\Illuminate\Support\Facades\Hash::make("test")
        ]);

        $adminRoleId = DB::table("roles")->insertGetId([
            "name"=>"temp_admin"
        ]);

        $permissionId = DB::table("permissions")
            ->select('id')
            ->where("name","=","admin")
            ->get();

        DB::table("role_permissions")->insert([
            "permission_id"=> $permissionId[0]->id,
            "role_id"=> $adminRoleId
        ]);

        DB::table("user_roles")->insert([
            "user_id" => $adminId,
            "role_id" => $adminRoleId
        ]);
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
