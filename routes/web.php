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

Route::get("/sections", "CategoriesController@getSections");
Route::get("/sections/{id}", "CategoriesController@getSectionInfo")->where(["id"=>"[0-9]+"]);


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
