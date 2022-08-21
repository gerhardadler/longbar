<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


use App\Guide;
use App\MyGuide;
use App\GuideBackup;
use App\Category;

class GuideController extends Controller
{
    public function __construct() {
        $this->middleware('auth', ['except' => ["index", "show"]]);
    }

    public function index() {
        $guides = Guide::select("name", "description", "slug")->take(20)->get();
        return view("guides.index", ["guides" => $guides]);
    }

    public function show(Guide $guide) {
        $guide["author"] = $guide->users()->where("orig_author", TRUE)->first()->name;
        $editors = [];
        $first_iteration = TRUE;
        foreach ($guide->users()->where("orig_author", FALSE)->get() as $editor) {
            if (($editor->name !== $guide["author"]) && (!in_array($editor->name, $editors))) {
                $editors[] = $editor->name;
            }
        }
        $guide["editors"] = !empty($editors) ? implode(", ", $editors) : NULL;
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
        return view("guides.create", ["guide" => $guide]);
    }

    public function store(Request $request) {
        $request["slug"] = Str::slug($request->name, '-');
        $request->validate([
            'name' => 'required|max:50',
            "slug" => "required|unique:guides",
            "description" => 'required|max:200',
            'content' => ['required', "max:16777215", 
                function ($attribute, $value, $fail) {
                    if (preg_match("/<script *>/", $value)) {
                        $fail("Don't include script tags (\"<script>\") in the content.");
                    }
                },
            ],
            "category" => "required"
        ],
        [
            "slug.unique" => "That title is already taken.",
            "content.max" => "The content cannot exceed 16 MB. Remove or compress images to meet that limitation.",
            "category.required" => "You must select at least one category for your guide."
        ]);

        if (strtolower($request->action) === "publish") {
            $guide = new Guide;
            $guide->name = $request->name;
            $guide->slug = $request->slug;
            $guide->description = $request->description;
            $guide->content = $request->content;
            $guide->save();

            $guide->users()->attach(Auth::id(), ['orig_author' => TRUE]);
            $guide->categories()->attach($request->category);
        } else {
            $my_guide = new MyGuide;
            $my_guide->name = $request->name;
            $my_guide->slug = $request->slug;
            $my_guide->description = $request->description;
            $my_guide->content = $request->content;
            $my_guide->user_id = Auth::id();
            $my_guide->save();
        }
    }

    public function edit(Guide $guide) {
        $guide["author"] = $guide->users()->where("orig_author", TRUE)->first()->name;
        $editors = [];
        $first_iteration = TRUE;
        foreach ($guide->users()->where("orig_author", FALSE)->get() as $editor) {
            if (($editor->name !== $guide["author"]) && (!in_array($editor->name, $editors))) {
                $editors[] = $editor->name;
            }
        }
        $guide["editors"] = !empty($editors) ? implode(", ", $editors) : NULL;
        $guide["is_new_guide"] = FALSE;
        return view("guides.edit", ["guide" => $guide]);
    }

    public function update(Request $request, Guide $guide) {
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
