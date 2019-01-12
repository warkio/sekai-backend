<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Thread extends Model
{
    protected $table = "threads";

    public function readedBy($userId){
        $exists = DB::table("readed_threads")
            ->where([["thread_id","=",$this->id], ["user_id","=",$userId]])
            ->first();
        if(!$exists){
            DB::table("readed_threads")->insert([
                "thread_id"=>$this->id,
                "user_id"=>$userId
            ]);
        }
        $result = DB::select(
            DB::raw(
              "SELECT is_read FROM readed_threads WHERE user_id=? AND thread_id=?"
            ),
            [$userId, $this->id]
        )[0];
        return $result->is_read;
    }
}
