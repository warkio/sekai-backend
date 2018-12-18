<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Permission;

class Role extends Model
{
    protected $table = "roles";
    protected $fillable = [
        "name", "description", "image"
    ];

    public function getPermissions(){
        $permissionsName = [];
        $result = DB::select(
            DB::raw(
                "select p.name,case when p2.name is null then false else true end as has_permission from permissions as p LEFT JOIN (select roles.name, role_permissions.permission_id from roles inner join role_permissions on roles.id = role_permissions.role_id and roles.id=?) as p2 on p.id = p2.permission_id;"
            ),
            [$this->id]
        );
        foreach($result as $key=>$permission){
           $permissionsName[$permission->name] = $permission->has_permission;
        }
        return $permissionsName;
    }
}
