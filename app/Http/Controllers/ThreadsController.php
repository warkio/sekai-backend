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
        $post = new Post();
        $post->thread_id = $thread->id;
        $post->content = $r->input("content");
        $post->user_id = $user->id;
        $post->save();

        return response()->json(["threadId"=>$thread->id, "postId"=>$post->id]);

    }

    public function editThread(Request $r, int $threadId){

    }

    public function getThreads(Request $r){
        $page = $r->has("page") && $r->input("page") > 0 ? $r->input("page") : 1;
        $quantity = $r->has("quantity") ? $r->input("quantity") : 15;
        $quantity = min(max($quantity, 1), 100);

        $threads = DB::table("threads");
        if($r->has("section-id") && is_numeric($r->input("section-id"))){
            $threads = $threads->where("section_id","=",$r->input("section-id"));
        }
        $total = $threads->count();
        $threads = $threads->limit($quantity)->offset(($page-1)*$quantity)->get();

        $data = [
            "total" => $total,
            "content" => []
        ];

        $postInfo = \App::make(PostsController::class);
        foreach($threads as $index=>$content){
            $data["content"][$index] = [
                "id"=>$content->id,
                "name"=>$content->name,
                "user"=>[
                    "id"=>$content->user_id,
                    "name"=>User::find($content->user_id)->get("name")
                ],
                "lastPost"=>$postInfo->postInfo(),
                "userId"=>$content->user_id,
                "isPinned"=>$content->is_pinned,
                "image"=>$content->image,
                "color"=>$content->color,

            ];
        }

        return response()->json($data, 200);
    }

    public function deleteThread(Request $r, int $threadId){
        $thread = Section::find($threadId);
        if(is_null($thread)){
            return response()->json(["error"=>"Invalid id"], 400);
        }
        try{
            $thread->delete();
        }
        catch (Exception $e){
            return response()->json(["error"=>$e], 500);
        }

        return response()->json(["success"=>true], 200);
    }
}
