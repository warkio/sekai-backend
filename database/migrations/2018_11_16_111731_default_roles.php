<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use \Illuminate\Support\Facades\DB;

class DefaultRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // User role
        $userRoleId = DB::table("roles")
            ->insertGetId([
                "name" => "user"
            ]);
        // Admin role
        $adminRoleId = DB::table("roles")
            ->insertGetId([
                "name" => "admin"
            ]);
        // Create post
        $createPostPermission = DB::table("permissions")
            ->select("id")
            ->where("name","=", "create post")
            ->get();
        $createPostPermission = $createPostPermission[0]->id;

        // Create thread
        $createThreadPermission = DB::table("permissions")
            ->select("id")
            ->where("name", "=", "create thread")
            ->get();
        $createThreadPermission = $createThreadPermission[0]->id;

        // By default, a user can create posts and threads
        DB::table("role_permissions")->insert([
            "permission_id"=> $createThreadPermission,
            "role_id"=> $userRoleId
        ]);

        DB::table("role_permissions")->insert([
            "permission_id"=> $createPostPermission,
            "role_id"=> $userRoleId
        ]);

        // Admin permission
        $adminPermission = DB::table("permissions")
            ->select("id")
            ->where("name", "=", "admin")
            ->get();
        $adminPermission = $adminPermission[0]->id;
        $adminPanelPermission = DB::table("permissions")
            ->select("id")
            ->where("name", "=", "admin panel")
            ->get();
        $adminPanelPermission = $adminPanelPermission[0]->id;

        // Admin role permissions
        DB::table("role_permissions")->insert([
            "permission_id"=> $adminPermission,
            "role_id"=> $adminRoleId
        ]);

        DB::table("role_permissions")->insert([
            "permission_id"=> $adminPanelPermission,
            "role_id"=> $adminRoleId
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
