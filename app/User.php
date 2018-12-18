<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;
use App\Permission;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'signature', 'on_rol_gold', 'off_rol_gold','experience'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getRoles(){
        // Get user Roles
        $roles = DB::table('roles')
            ->join("user_roles", "roles.id", "=", "user_roles.role_id")
            ->where("user_roles.user_id","=",$this->id)
            ->select("roles.id", "roles.name")
            ->get();
        $rolesNames = [];
        foreach($roles as $key=>$role){
            array_push($rolesNames, [
                    "name"=>$role->name,
                    "id"=>$role->id
                ]
            );
        }
        return $rolesNames;
    }

    public function getPermissions(){
        // Get user roles
        $roles = $this->getRoles();
        // All available permissions
        $permissionNames = Permission::all();
        $userPermissions = [];
        // Initialize all of them as false
        foreach($permissionNames as $key=>$permission){
            $userPermissions[$permission->name] = false;
        }
        // Find the user permissions
        foreach($roles as $key=>$role){
            $roleObj = Role::find($role["id"]);
            foreach ($roleObj->getPermissions() as $permissionName => $permissionValue){
                $userPermissions[$permissionName] = $userPermissions[$permissionName] || $permissionValue;
            }
        }
        return $userPermissions;
    }
}
