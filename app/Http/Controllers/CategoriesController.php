<?php

namespace App\Http\Controllers;

use App\Category;
use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Role;

class CategoriesController extends Controller
{

    /**
     * Receives name as mandatory parameter
     * @param Request $r
     * @return \Illuminate\Http\JsonResponse
     */
    public function createCategory(Request $r){
        $user = Auth::user();
        if(!$user){
            return response()->json(["error"=>"Unauthorized"], 401);
        }
        $userPermisions = $user->getPermissions();
        if(!$userPermisions["admin"] && !$userPermisions["create category"]){
            return response()->json(["error"=>"Unauthorized"], 401);
        }
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
        $user = Auth::user();
        if(!$user){
            return response()->json(["error"=>"Unauthorized"], 401);
        }
        $userPermisions = $user->getPermissions();
        if(!$userPermisions["admin"] && !$userPermisions["edit category"]){
            return response()->json(["error"=>"Unauthorized"], 401);
        }
        $category = Category::find($id);
        // Category not found
        if(is_null($category)){
            return response()->json(["error"=>"Invalid category"], 400);
        }
        if(!$r->has("name") && !$r->has("description") && !$r->has("image") && !$r->has("color")){
            return response()->json(["error"=>"You must edit something"], 400);
        }
        if($r->has("name")){
            $categoryVerification = Category::where("name", "=", $r->input("name"))->get();
            if(!$categoryVerification->isEmpty()){
                return response()->json(["error"=>"Category name already in use"], 400);
            }

        }

        // Edit category info
        $category->name =$r->has("name")? $r->input("name") : $category->description;
        $category->description = $r->has("description")? $r->input("description") : $category->name;
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

    private function getAllCategories(bool $ignoreWithEmptySections = true){
        $categories = Category::All();
        $data = [
            "total"=> Category::count(),
            "content"=> []
        ];
        $sectionController = \App::make(SectionsController::class);
        foreach ($categories as $index=>$content){
            $sections = $sectionController->getSectionsByCategory($content->id);
            if($ignoreWithEmptySections && empty($sections)){
                continue;
            }
            $data["content"][$index] = [
                "id"=>$content->id,
                "name"=>$content->name,
                "description"=>$content->description,
                "image"=>$content->image,
                "color"=>$content->color,
                "sections"=> $sections,
            ];
        }
        return $data;
    }

    /**
     * Gets all categories
     * @param Request $r
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCategories(Request $r){
        return response()->json($this->getAllCategories(false));
    }

    /**
     * Render the main page
     * @param Request $r
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function renderMainPage(Request $r){
        return view("index", ["categories"=>$this->getAllCategories()["content"]]);
    }

    public function deleteCategory(Request $r, int $categoryId){
        $user = Auth::user();
        if(!$user){
            return response()->json(["error"=>"Unauthorized"], 401);
        }
        $userPermisions = $user->getPermissions();
        if(!$userPermisions["admin"] && !$userPermisions["delete category"]){
            return response()->json(["error"=>"Unauthorized"], 401);
        }
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
