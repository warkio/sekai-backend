<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use App\Section;
use App\utils\StringHelper;
use Illuminate\Support\Facades\DB;

class ThreadsController extends Controller
{
    public function createThread(Request $r){
        $user = Auth::user();

        // Check name
        if(!$r->has("name")){
            return response()->json(["error"=>"Name needed"]);
        }
        if(!$r->has("sectionId") || ! is_int($r->input("sectionId"))){
            return response()->json(["error"=>"No section id"], 400);
        }
        else{
            $section = Section::find($r->input("sectionId"));
            if(is_null($section)){
                return response()->json(["error"=>"Invalid section"], 400);
            }
        }

        $thread = new Thread();
        $thread->name = $r->input("name");
        $thread->slug = StringHelper::makeSlug($r->input("name"));
        $thread->description = $r->has("description") ? $r->input("description") : null;


    }

    public function editThread(Request $r, int $threadId){

    }

    public function getThreads(Request $r){
        $page = $r->has("page") && $r->input("page") > 0 ? $r->input("page") : 1;
        $quantity = $r->has("quantity") ? $r->input("quantity") : 15;
        $quantity = min(max($quantity, 1), 100);

        $threads = DB::table("threads");
        if($r->has("section-id") && is_int($r->input("section-id"))){
            $threads = $threads->where("section_id","=",$r->input("section-id"));
        }
        $total = $threads->count();
        $threads = $threads->limit($quantity)->offset(($page-1)*$quantity)->get();

        $data = [
            "total" => $total,
            "content" => []
        ];

        foreach($threads as $index=>$content){
            $data["content"][$index] = [
                "id"=>$content->id,
                "name"=>$content->name,
                "userId"=>$content->user_id,
                "isPinned"=>$content->is_pinned,
                "slug"=>$content->slug,
                "image"=>$content->image,
                "color"=>$content->color,
                "sectionId"=>$content->section_id
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
