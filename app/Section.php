<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Controllers\PostsController;

class Section extends Model
{
    protected $table = "sections";

    public function isReadBy($userId){
        $query = "select * from (select distinct on (id) * from ( SELECT threads.*, posts.created_at as last_post_date, posts.id as post_id from threads left join posts on posts.thread_id = threads.id order by last_post_date asc) as threads) as res where section_id=? order by last_post_date desc";
        $threads = DB::select(
            DB::raw(
                $query
            ),
            [$this->id]
        );
        $postInfo = \App::make(PostsController::class);
        $user = User::find($userId);
        foreach ($threads as $index=>$content){
            $lastPost = Carbon::parse($postInfo->postInfo($content->post_id)["date"]);
            $thread = Thread::find($content->id);
            $isRead = $user->created_at > $lastPost? true : $thread->isReadBy($userId);
            if(!$isRead){
                return false;
            }
        }
        return true;
    }
}
