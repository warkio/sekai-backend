<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Thread;
use App\Section;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ThreadsController extends Controller
{
    public function createThread(Request $r){
        $user = Auth::user();
        if(!$user){
            return response()->json(["error"=>"You must be logged in"], 401);
        }

        // Check name
        if(!$r->has("name")){
            return response()->json(["error"=>"Name needed"], 400);
        }
        if(!$r->has("sectionId") || ! is_numeric($r->input("sectionId"))){
            return response()->json(["error"=>"No section id"], 400);
        }
        if(!$r->has("content")){
            return response()->json(["error"=>"Post content needed"], 400);
        }
        else{
            $section = Section::find($r->input("sectionId"));
            if(is_null($section)){
                return response()->json(["error"=>"Invalid section"], 400);
            }
        }

        $thread = new Thread();
        $thread->name = $r->input("name");
        $thread->section_id = $r->input("sectionId");
        $thread->user_id = $user->id;
        $thread->description = $r->has("description") ? $r->input("description") : null;
        $thread->save();
        // TODO - User reward when creating post
        try{
            $post = new Post();
            $post->thread_id = $thread->id;
            $post->content = $r->input("content");
            $post->user_id = $user->id;
            $post->save();
        }
        catch (\Exception $e){
            $thread->delete();
            return response()->json(["error"=>"Server error"], 500);
        }


        return response()->json(["threadId"=>$thread->id, "postId"=>$post->id]);

    }

    public function editThread(Request $r, int $threadId){
        $user = Auth::user();
        if(!$user){
            return response()->json(["error"=>"unauthorized"], 401);
        }
        $userPermissions = $user->getPermissions();
        $thread = Post::find($threadId);
        // Check posts existence
        if(is_null($thread)){
            return response()->json(["error"=>"Invalid id"], 400);
        }
        // Only admin, moderators and own user can edit post
        if(!$userPermissions["admin"] && !$userPermissions["edit thread"] && $post->user_id != $user->id){
            return response()->json(["error"=>"unauthorized"], 401);
        }

        // Change pinned value
        if(($userPermissions["admin"] || $userPermissions["edit thread"] ) && $r->has("pinned")){
            if(is_bool($r->input("pinned"))){
                $thread->is_pinned = $r->input("pinned");
            }
        }

        if($r->has("name") && is_string($r->input("name"))){
            $thread->name = $r->input("name");
        }
        if($r->has("description") && is_string($r->input("description"))){
            $thread->description = $r->input("description");
        }

        $thread->save();

        return response()->json(["success"=>true], 200);

    }

    public function getThreads(Request $r){
        $page = $r->has("page") && $r->input("page") > 0 ? $r->input("page") : 1;
        $quantity = $r->has("quantity") ? $r->input("quantity") : 15;
        $quantity = min(max($quantity, 1), 100);

        $getPinned = $r->has("section-id");
        $threads = DB::table("threads");
        if($r->has("section-id") && is_numeric($r->input("section-id"))){
            $threads = $threads->where("section_id","=",$r->input("section-id"));
        }
        $pinnedThreads = [];
        $postInfo = \App::make(PostsController::class);
        $query = "select * from (select distinct on (id) * from ( SELECT threads.*, posts.created_at as last_post_date, posts.id as post_id from threads left join posts on posts.thread_id = threads.id order by last_post_date asc) as threads) as res";
        if($getPinned){
            $pinned = DB::select(
                DB::raw(
                    $query . " WHERE is_pinned=true AND section_id=?"
                ),
                [$r->input("section-id")]
            );
            // We dont want pinned threads on the other query
            $threads = $threads->where("is_pinned","=",false);
            foreach ($pinned as $index => $content){
                array_push($pinnedThreads, [
                    "id"=>$content->id,
                    "name"=>$content->name,
                    "user"=>[
                        "id"=>$content->user_id,
                        "name"=>User::find($content->user_id)->name
                    ],
                    "lastPost"=>$postInfo->postInfo($content->post_id),
                    "userId"=>$content->user_id,
                    "isPinned"=>$content->is_pinned,
                ]);
            }
        }
        $total = $threads->count();
        //$threads = $threads->limit($quantity)->offset(($page-1)*$quantity)->get();


        $params = [];
        if($getPinned){
            $query .= " WHERE is_pinned=false AND section_id=?";
            array_push($params, $r->input("section-id"));
        }
        $query .= " order by last_post_date desc limit ? offset ?";
        array_push($params, $quantity);
        array_push($params, ($page-1)*$quantity);
        $threads = DB::select(
            DB::raw(
                $query
            ),
            $params
        );
        $data = [
            "total" => $total,
            "content" => []
        ];
        if($getPinned){
            $data["pinned"] = $pinnedThreads;
        }


        foreach($threads as $index=>$content){
            array_push($data["content"], [
                "id"=>$content->id,
                "name"=>$content->name,
                "user"=>[
                    "id"=>$content->user_id,
                    "name"=>User::find($content->user_id)->name
                ],
                "lastPost"=>$postInfo->postInfo($content->post_id),
                "userId"=>$content->user_id,
                "isPinned"=>$content->is_pinned,
            ]);
        }

        return response()->json($data, 200);
    }

    public function deleteThread(Request $r, int $threadId){
        $user = Auth::user();
        if(!$user){
            return response()->json(["error"=>"unauthorized"], 401);
        }
        $userPermissions = $user->getPermissions();
        if(!$userPermissions["admin"] && !$userPermissions["delete thread"]){
            return response()->json(["error"=>"unauthorized"], 401);
        }
        $thread = Section::find($threadId);
        if(is_null($thread)){
            return response()->json(["error"=>"Invalid id"], 400);
        }

        try{
            $thread->delete();
        }
        catch (\Exception $e){
            return response()->json(["error"=>$e], 500);
        }

        return response()->json(["success"=>true], 200);
    }
}
