<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


use App\Guide;
use App\GuideBackup;
use App\Category;

class GuideController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */

    public function __construct() {
        $this->middleware('auth', ['except' => ["index", "show"]]);
    }

    public function index() {
        $guides = Guide::select("name", "description", "slug")->take(20)->get();
        return view("guides.index", ["guides" => $guides]);
    }

    public function show($slug) {
        $guide = Guide::where("slug", $slug)->firstOrFail();
        return view("guides.show", ["guide" => $guide]);
    }

    public function create() {
        $guide = [
            "name" => "Write your title here",
            "description" => "Write your description here",
            "author" => Auth::user()["name"],
            "content" => "<p>Write your content here</p>",
            "is_new_guide" => TRUE
        ];
        return view("guides.editor", ["guide" => $guide]);
    }

    public function store(Request $request) {
        try {
            $guide = new Guide;
            $guide->name = $request->input("name");
            $guide->slug = Str::slug($request->input("name"), "-");
            $guide->description = $request->input("description");
            $guide->content = $request->input("content"); // TODO: protect against script tags
            $guide->save();

            $category_array = [];
            for($id = 1; $id <= 7; $id++) {
                if($request->has("category_$id")) {
                    $category_array[] = $id;
                }
            }
            $guide->categories()->attach($category_array);

            $guide->users()->attach(Auth::id(), ['orig_author' => TRUE]);

            return $category_array;
        } catch(\Exception $e) { // In case someone posts a guide with an existing name
            if($e->getCode() == 23000) {
                return "Your title is too similar to an existing title.";
            }
        }
    }

    public function edit($slug) {
        $guide = Guide::where("slug", $slug)->firstOrFail();
        $guide["slug"] = $slug;
        $guide["author"] = $guide->users()->where("orig_author", TRUE)->first()->name;
        $guide["editors"] = "";
        $first_iteration = TRUE;
        foreach ($guide->users()->where("orig_author", FALSE)->get() as $editor) {
            if ($first_iteration) {
                $guide["editors"] .= $editor->name;
                $first_iteration = FALSE;
            } else {
                $guide["editors"] .= ", " . $editor->name;
            }
        }
        $guide["is_new_guide"] = FALSE;
        return view("guides.editor", ["guide" => $guide]);
    }

    public function update(Request $request, $slug) {
        $guide = Guide::where("slug", $slug)->first();

        $guide_backup = new GuideBackup;
        $guide_backup->name = $guide->name;
        $guide_backup->description = $guide->description;
        $guide_backup->content = $guide->content; // TODO: protect against script tags
        $guide_backup->save();

        $guide->name = $guide->name;
        $guide->slug = Str::slug($guide->name, "-");
        $guide->description = $request->input("description");
        $guide->content = $request->input("content"); // TODO: protect against script tags
        $guide->save();

        $guide->users()->attach(Auth::id(), ['orig_author' => FALSE]);
    }
}
