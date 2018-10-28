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

Route::get('/', function () {
    return view('welcome');
});

Route::get("/threads", function(){
    return view("threads");
});

Route::get("/categories", "CategoriesController@getCategories");
Route::get("/categories/{id}", "CategoriesController@getCategoryInfo")->where(["id"=>"[0-9]+"]);
Route::post("/categories", "CategoriesController@createCategory");

Route::get("/sections", "SectionsController@getSections");
Route::get("/sections/{id}", "SetionsController@getSectionInfo")->where(["id"=>"[0-9]+"]);
Route::post("/sections", "SectionsController@createCategory");

Route::get("/threads", "ThreadsController@getThreads");
Route::get("/threads/{id}", "ThreadsController@getThreadInfo")->where(["id"=>"[0-9]+"]);
Route::post("/threads", "ThreadsController@createThread");


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
