<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use Illuminate\Support\Facades\Auth;
use App\Category;
use Illuminate\Support\Facades\DB;

class SectionsController extends Controller
{

    public function getSectionsByCategory(int $id){
        $data = [];
        $sections = Section::All()->where("category_id", "=", $id);
        foreach ($sections as $index=>$section){
            $data[$index] = [
                "id"=>$section->id,
                "image"=>$section->image,
                "color"=>$section->color,
                "name"=>$section->name,
                "description"=>$section->description
            ];
        }
        return $data;
    }
    /**
     * Creates a new section for a determined category
     * @param Request $r
     * @return \Illuminate\Http\JsonResponse
     */
    public function createSection(Request $r){
        $user = Auth::user();
        if(!$user){
            return response()->json(["error"=>"Unauthorized"], 401);
        }
        $userPermisions = $user->getPermissions();
        if(!$userPermisions["admin"] && !$userPermisions["create section"]){
            return response()->json(["error"=>"Unauthorized"], 401);
        }
        // Check if the category id is passed
        if(!$r->has("categoryId") || !is_numeric($r->input("categoryId"))){
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

        $previousSection = Section::
            where([
                "name" => $r->input("name"),
                "category_id" => $r->input("categoryId")
            ])->get();
        // Unique name boi
        if(!$previousSection->isEmpty()){
            return response()->json(["error"=>"Section already exists with that name for that category"], 400);
        }
        $section = new Section();
        // Name and slug
        $section->category_id = $category->id;
        $section->name = $r->input("name");
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
        if($r->has("category-id") && is_numeric($r->input("category-id"))){
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
                "image"=>$content->image,
                "color"=>$content->color,
                "categoryId"=>$content->category_id,
                "readed"=>false // TODO - Create the function for calculate this
            ];
        }

        return response()->json($data, 200);
    }

    /**
     * Returns the sections, being possible to filter them by page and quantity
     * @param Request $r
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSectionInfo(Request $r, int $id){

        $content = Section::find($id);
        if(is_null($content)){
            return response()->json(["error"=>"Section not found"], 404);
        }

        $data = [
            "id"=>$content->id,
            "name"=>$content->name,
            "image"=>$content->image,
            "color"=>$content->color,
            "categoryId"=>$content->category_id
        ];

        return response()->json($data, 200);
    }

    /**
     * Edits a determined section
     * @param Request $r
     * @param int $sectionId
     * @return \Illuminate\Http\JsonResponse
     */
    public function editSection(Request $r, int $sectionId){
        $user = Auth::user();
        if(!$user){
            return response()->json(["error"=>"Unauthorized"], 401);
        }
        $userPermisions = $user->getPermissions();
        if(!$userPermisions["admin"] && !$userPermisions["edit section"]){
            return response()->json(["error"=>"Unauthorized"], 401);
        }
        $section = Section::find($sectionId);
        if(is_null($section)){
            return response()->json(["error"=>"Invald section"], 400);
        }
        if(!$r->has("name") && !$r->has("color") && !$r->has("image") && !$r->has("description")){
            return response()->json(["error"=>"You must edit something"], 400);
        }
        $section->name = $r->has("name")? $r->input("name") : $section->name;
        $section->color = $r->has("color")? $r->input("color") : $section->color;
        $section->image = $r->has("image")? $r->input("image") : $section->image;
        $section->description = $r->has("description")? $r->input("description") : $section->description;
        $section->save();
        return response()->json(["success"=>true], 200);
    }

    public function deleteSection(Request $r, int $sectionId){
        $user = Auth::user();
        if(!$user){
            return response()->json(["error"=>"Unauthorized"], 401);
        }
        $userPermisions = $user->getPermissions();
        if(!$userPermisions["admin"] && !$userPermisions["delete section"]){
            return response()->json(["error"=>"Unauthorized"], 401);
        }
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
