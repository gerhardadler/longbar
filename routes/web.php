<?php

use Illuminate\Support\Facades\Route;

use App\Guide;
use App\Category;

use App\Http\Controllers\GuideController;
use App\Http\Controllers\CategoryController;

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

Route::view("/", "static/home");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get("/guides", [GuideController::class, "index"]);
Route::get("/guides/create", [GuideController::class, "create"]);
Route::post("/guides/create", [GuideController::class, "store"]);
Route::get("/guides/{guide:slug}", [GuideController::class, "show"]);
Route::get("/guides/{guide:slug}/edit", [GuideController::class, "edit"]);
Route::post("/guides/{guide:slug}", [GuideController::class, "update"]);
// Route::get("/user/{user:slug}/guides/{guide:slug}/edit");

Route::get("/{category:slug}", [CategoryController::class, "show"]);
