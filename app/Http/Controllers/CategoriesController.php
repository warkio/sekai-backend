<?php

namespace App\Http\Controllers;

use App\Category;
use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{

    /**
     * Receives name as mandatory parameter
     * @param Request $r
     * @return \Illuminate\Http\JsonResponse
     */
    public function createCategory(Request $r){
        if(!$r->has("name")){
            return response()->json(["error"=>"Invalid parameters"], 400);
        }

        $categoryVerification = Category::where("name", "=", $r->input("name"))->get();
        if(!$categoryVerification->isEmpty()){
            return response()->json(["error"=>"Category name already in use"], 400);
        }
        $category = new Category();
        $category->name = $r->input("name");
        // Optional description
        if($r->has("description") && is_string($r->input("description"))){
            $category->description = $r->input("description");
        }
        // Optional image
        if($r->has("image") && is_string($r->input("image"))){
            $category->image = $r->input("image");
        }

        if($r->has("color") && is_string($r->input("color"))){
            $category->color = $r->input("color");
        }
        $category->save();

        return response()->json(["id"=>$category->id],200);
    }

    /**
     * Edit an existing category
     * @param Request $r
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function editCategory(Request $r, int $id){
        $category = Category::find($id);
        // Category not found
        if(is_null($category)){
            return response()->json(["error"=>"Invalid category"], 400);
        }
        // Edit category info
        $category->name = $r->input("name");
        $category->description = $r->has("description")? $r->input("Description") : $category->description;
        $category->image = is_string($r->input("image")) ? $r->input("image") : $category->image;
        $category->color = is_string($r->input("color")) ? $r->input("color") : $category->color;
        return response()->json(["success"=>true],200);
    }

    /**
     * Gets all info of a determined category
     * @param Request $r
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCategoryInfo(Request $r, int $id){
        $category = Category::find($id);

        if(is_null($category)){
            return response()->json(["error"=>"Invalid id"], 400);
        }
        return response()->json([
            "id"=>$category->id,
            "name"=>$category->name,
            "description"=>$category->description,
            "image"=>$category->image,
            "color"=>$category->color
        ]);
    }


    /**
     * Gets all categories
     * @param Request $r
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCategories(Request $r){
        $categories = Category::All();
        $data = [
            "total"=> Category::count(),
            "content"=> []
        ];
        $sectionController = \App::make(SectionsController::class);
        foreach ($categories as $index=>$content){
            $data["content"][$index] = [
                "id"=>$content->id,
                "name"=>$content->name,
                "description"=>$content->description,
                "image"=>$content->image,
                "color"=>$content->color,
                "sections"=> $sectionController->getSectionsByCategory($content->id)
            ];
        }
        return response()->json($data);
    }

    public function deleteCategory(Request $r, int $categoryId){
        $category = Category::find($categoryId);
        if(is_null($category)){
            return response()->json(["error"=>"Invalid id"], 400);
        }
        try{
            $category->delete();
        }
        catch (Exception $e){
            return response()->json(["error"=>$e], 500);
        }

        return response()->json(["success"=>true], 200);
    }

}
