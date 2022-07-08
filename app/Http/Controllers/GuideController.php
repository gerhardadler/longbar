<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;


use App\Guide;
use App\Category;

class GuideController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */

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

    public function store(Request $request) {
        try {
            $guide = new Guide;
            $guide->name = $request->input("name");
            $guide->slug = Str::slug($request->input("name"), "-");
            $guide->description = $request->input("description");
            $guide->content = $request->input("content"); // TODO: protect against script tags
            $guide->orig_version = TRUE;
            $guide->save();

            $category_array = [];
            for($id = 1; $id <= 7; $id++) {
                if($request->has("category_$id")) {
                    $category_array[] = $id;
                }
            }

            return $category_array;
        } catch(\Exception $e) { // In case someone posts a guide with an existing name
            if($e->getCode() == 23000) {
                return "Your title is too similar to an existing title.";
            }
        }
    }
}
