<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use App\Section;
use App\utils\StringHelper;

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

    }

    public function deleteThread(Request $r){

    }
}
