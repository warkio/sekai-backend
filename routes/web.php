<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', "CategoriesController@renderMainPage");

Route::get("/threads", function(){
    return view("threads");
});

Route::get("/categories", "CategoriesController@getCategories");
Route::get("/categories/{id}", "CategoriesController@getCategoryInfo")->where(["id"=>"[0-9]+"]);
Route::post("/categories", "CategoriesController@createCategory");
Route::post("/unsafe-categories", "CategoriesController@createCategory");
Route::delete("/categories/{id}", "CategoriesController@deleteCategory")->where(["id"=>"[0-9]+"]);

Route::get("/sections", "SectionsController@getSections");
Route::get("/sections/{id}", "SectionsController@getSectionInfo")->where(["id"=>"[0-9]+"]);
Route::post("/sections", "SectionsController@createSection");
Route::post("/unsafe-sections", "SectionsController@createSection");
Route::delete("/sections/{id}", "SectionsController@deleteSection")->where(["id"=>"[0-9]+"]);

Route::get("/threads", "ThreadsController@getThreads");
Route::get("/threads/{id}", "ThreadsController@getThreadInfo")->where(["id"=>"[0-9]+"]);
Route::post("/threads", "ThreadsController@createThread");
Route::post("/unsafe-threads", "ThreadsController@createThread");
Route::delete("/threads/{id}", "ThreadsController@deleteThread")->where(["id"=>"[0-9]+"]);

Route::get("/posts", "PostsController@getPosts");
Route::get("/posts/{id}", "PostsController@getPostInfo")->where(["id"=>"[0-9]+"]);
Route::post("/posts", "PostsController@createPost");
Route::post("/unsafe-posts", "PostsController@createPost");
Route::delete("/posts/{id}", "PostsController@deletePost")->where(["id"=>"[0-9]+"]);

Route::get("/token", function(){
    return response()->json(["token"=>\Illuminate\Support\Facades\Session::token()]);
});


Route::get("/user", function(){
    $user = Auth::user();
    unset($user["created_at"]);
    unset($user["updated_at"]);
    if($user)
        $user["permissions"] = $user->getPermissions();
    return response()->json($user);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
