<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Guide;
use App\Category;

class GuideController extends Controller
{
    public function index() {
        $guides = Guide::select("name", "description", "slug")->take(20)->get();
        return view("guides.index", ["guides" => $guides]);
    }

    public function show($slug) {
        $guide = Guide::where("slug", $slug)->firstOrFail();
        return view("guides.show", ["guide" => $guide]);
    }

    public function create() {
        return view("guides.create");
    }
}
