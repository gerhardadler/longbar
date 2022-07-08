<?php

use Illuminate\Support\Facades\Route;

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

Route::get("/guides", [GuideController::class, "index"]);
Route::get("/guides/create", [GuideController::class, "create"]);
Route::post("/guides/create", [GuideController::class, "store"]);
Route::get("/guides/{categories:slug}", [GuideController::class, "show"]);

Route::get("/{categories:slug}", [CategoryController::class, "show"]);
