<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use App\Category;
use App\utils\StringHelper;
use Illuminate\Support\Facades\DB;

class SectionsController extends Controller
{
    /**
     * Creates a new section for a determined category
     * @param Request $r
     * @return \Illuminate\Http\JsonResponse
     */
    public function createSection(Request $r){
        // Check if the category id is passed
        if(!$r->has("categoryId") || !is_int($r->input("categoryId"))){
            return response()->json(["error"=>"Category id must be integer"], 400);
        }
        // Verify category existence
        $category = Category::find($r->input("categoryId"));
        if(is_null($category)){
            return response()->json(["error"=>"Invalid category id"], 400);
        }

        // Check name
        if(!$r->has("name") || !is_string($r->input("name"))){
            return response()->json(["error"=>"Invalid name"]);
        }

        $section = new Section();
        // Name and slug
        $section->name = $r->input("name");
        $section->slug = StringHelper::makeSlug($r->input("name"));
        // Image
        if($r->has("image") && is_string($r->input("image"))){
            $section->image = $r->input("image");
        }

        // Color
        if($r->has("color") && is_string($r->input("color"))){
            $section->color = $r->input("color");
        }

        // Description
        if($r->has("description") && is_string($r->input("description"))){
            $section->description = $r->input("description");
        }

        $section->save();

        return response()->json(["id"=>$section->id]);
    }

    /**
     * Returns the sections, being possible to filter them by page and quantity
     * @param Request $r
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSections(Request $r){
        $page = $r->has("page") && $r->input("page") > 0 ? $r->input("page") : 1;
        $quantity = $r->has("quantity") ? $r->input("quantity") : 15;
        $quantity = min(max($quantity, 1), 100);

        $sections = DB::table("sections");
        if($r->has("category-id") && is_int($r->input("category-id"))){
            $sections = $sections->where("category_id","=",$r->input("category-id"));
        }
        $total = $sections->count();
        $sections = $sections->limit($quantity)->offset(($page-1)*$quantity)->get();

        $data = [
            "total" => $total,
            "content" => []
        ];

        foreach($sections as $index=>$content){
            $data["content"][$index] = [
                "id"=>$content->id,
                "name"=>$content->name,
                "slug"=>$content->slug,
                "image"=>$content->image,
                "color"=>$content->color,
                "categoryId"=>$content->category_id
            ];
        }

        return response()->json($data, 200);
    }

    /**
     * Edits a determined section
     * @param Request $r
     * @param int $sectionId
     * @return \Illuminate\Http\JsonResponse
     */
    public function editSection(Request $r, int $sectionId){
        $section = Section::find($sectionId);
        if(is_null($section)){
            return response()->json(["error"=>"Invald section"], 400);
        }
        if(!$r->has("name")){
            return response()->json(["error"=>"Invald request"]);
        }
        $section->name = $r->input("name");
        $section->slug = StringHelper::makeSlug($r->input("name"));
        $section->color = $r->input("color");
        $section->image = $r->input("image");
        $section->description = $r->input("description");
        $section->save();
        return response()->json(["success"=>true], 200);
    }

    public function deleteSection(Request $r, int $sectionId){
        $section = Section::find($sectionId);
        if(is_null($section)){
            return response()->json(["error"=>"Invalid id"], 400);
        }
        try{
            $section->delete();
        }
        catch (Exception $e){
            return response()->json(["error"=>$e], 500);
        }

        return response()->json(["success"=>true], 200);
    }

}
