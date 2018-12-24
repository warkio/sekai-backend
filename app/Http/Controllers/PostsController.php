<?php

namespace App\Http\Controllers;

use App\Post;
use App\Thread;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * Creates a new post. Requires:
     * - Being auth
     * - Thread id
     * - Text
     * @param Request $r
     * @return \Illuminate\Http\JsonResponse
     */
    public function createPost(Request $r){
        $user = Auth::user();
        // User needs to be logged in
        if(!$user){
            return response()->json(["error"=>"You must be logged in"], 401);
        }
        $userPermissions = $user->getPermissions();
        if(!$userPermissions["admin"] && !$userPermissions["create post"]){
            return response()->json(["error"=>"unauthorized"], 401);
        }
        // Check name
        if(!$r->has("content") || strlen($r->input("content")) == 0){
            return response()->json(["error"=>"content needed"]);
        }
        if(!$r->has("threadId") || ! is_numeric($r->input("threadId"))){
            return response()->json(["error"=>"No section id"], 400);
        }

        // Check thread existence
        $thread = Thread::find($r->input("threadId"));
        if(is_null($thread)){
            return response()->json(["error"=>"Invalid thread"], 400);
        }
        // Create new post
        $post = new Post();
        $post->thread_id = $r->input("threadId");
        // TODO - User rewards
        $post->content = $r->input("content");
        $post->user_id = $user->id;
        $post->save();
        return response()->json(["id"=>$post->id],200);
    }

    public function getPosts(Request $r){
        $page = $r->has("page") && $r->input("page") > 0 ? $r->input("page") : 1;
        $quantity = $r->has("quantity") ? $r->input("quantity") : 15;
        $quantity = min(max($quantity, 1), 100);

        $posts = DB::table("posts");
        if($r->has("thread-id") && is_numeric($r->input("thread-id"))){
            $posts = $posts->where("thread_id","=",$r->input("thread-id"));
        }
        $total = $posts->count();
        $posts = $posts->limit($quantity)->offset(($page-1)*$quantity)->get();

        $data = [
            "total" => $total,
            "users" => [],
            "content" => []
        ];

        foreach($posts as $index=>$content){
            // Get the user info
            if(!array_key_exists($content->user_id, $data["users"])){
                $user = User::find($content->user_id);
                $data["users"][$content->user_id] = [
                    "onRolMoney" => $user->on_rol_money,
                    "offRolMoney" => $user->off_rol_money,
                    "level" => $user->level,
                    "exp" => $user->exp,
                    "avatar" => $user->avatar,
                    "signature" => $user->signature,

                ];
            }
            $data["content"][$index] = [
                "id"=>$content->id,
                "content"=>$content->content,
                "lastUpdatedBy"=>$content->last_updated_by,
                "lastUpdateReason"=>$content->last_update_reason,
                "userId"=>$content->user_id,
                "threadId"=>$content->thread_id
            ];
        }

        return response()->json($data, 200);
    }

    public function  getPostInfo(Request $r, int $postId){
        $post = Post::find($postId);
        if(is_null($post)){
            return null;
        }
        // User info
        $userInfo = User::find($post->user_id);
        $data = [
            "id"=>$post->id,
            "content"=>$post->content,
            "threadId"=>$post->thread_id,
            "userInfo"=>[
                "id"=>$userInfo->id,
                "name"=>$userInfo->name
            ]
        ];

        if(!is_null($post->last_updated_by)){
            $lastUpdateUser = User::find($post->last_updated_by);
            $lastUpdate = [
                "id" => $lastUpdateUser->id,
                "name"=> $lastUpdateUser->name,
                "reason" => $post->last_update_reason
            ];
        }

        $data["lastUpdate"] = $lastUpdate;
        return $data;
    }

    public function editPost(Request $r, int $postId){
        $user = Auth::user();
        if(!$user){
            return response()->json(["error"=>"unauthorized"], 401);
        }
        $userPermissions = $user->getPermissions();
        $post = Post::find($postId);
        // Check posts existence
        if(is_null($post)){
            return response()->json(["error"=>"Invalid id"], 400);
        }
        // Only admin, moderators and own user can edit post
        if(!$userPermissions["admin"] && !$userPermissions["edit post"] && $post->user_id != $user->id){
            return response()->json(["error"=>"unauthorized"], 401);
        }

        if(!$r->has("content") || !is_string($r->input('content'))){
            return response()->json(["error"=>"Invalid content"], 400);
        }


        $post->content = $r->input("content");
        if($r->has("editReason") && is_string($r->input("editReason"))){
            $post->last_update_reason = $r->input("editReason");
        }
        $post->last_updated_by = $user->id;

        $post->save();

        return response()->json(["success"=>true], 200);

    }

    public function deletePost(Request $r, int $postId){
        $user = Auth::user();
        if(!$user){
            return response()->json(["error"=>"unauthorized"], 401);
        }
        $userPermissions = $user->getPermissions();
        $post = Post::find($postId);
        // Check posts existence
        if(is_null($post)){
            return response()->json(["error"=>"Invalid id"], 400);
        }
        // Only admin and moderators can delete posts
        if(!$userPermissions["admin"] && !$userPermissions["delete post"]){
            return response()->json(["error"=>"unauthorized"], 401);
        }
        try{
            $post->delete();
        }
        catch (Exception $e){
            return response()->json(["error"=>$e], 500);
        }

        return response()->json(["success"=>true], 200);
    }
}
