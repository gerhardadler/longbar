<?php

use Illuminate\Support\Facades\Route;

use App\Guide;
use App\UnfinishedGuide;
use App\Category;

use App\Http\Controllers\GuideController;
use App\Http\Controllers\UnfinishedGuideController;
use App\Http\Controllers\CategoryController;

Route::view("/", "static/home");

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get("/guides", [GuideController::class, "index"]);
Route::get("/guides/create", [GuideController::class, "create"]);
Route::post("/guides/create", [GuideController::class, "store"]);
Route::get("/guides/{guide:slug}", [GuideController::class, "show"]);
Route::get("/guides/{guide:slug}/edit", [GuideController::class, "edit"]);
Route::post("/guides/{guide:slug}", [GuideController::class, "update"]);
Route::get("/unfinished-guides/{unfinished_guide:slug}/edit", [UnfinishedGuideController::class, "edit"]);
Route::post("/unfinished-guides/{unfinished_guide:slug}", [UnfinishedGuideController::class, "update"]);

Route::get("/{category:slug}", [CategoryController::class, "show"]);
