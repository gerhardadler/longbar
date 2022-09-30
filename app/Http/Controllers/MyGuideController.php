<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\MyGuide;
use App\GuideBackup;
use App\User;

class MyGuideController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $guides = Auth::user()->myGuides;
        $guides = $guides->merge(Auth::user()->Guides);
        return view("my_guides.index", ["guides" => $guides]);
    }

    public function edit(MyGuide $my_guide)
    {
        $my_guide["author"] = Auth::user()["name"];
        $my_guide["is_new_guide"] = FALSE;
        return view("my_guides.edit", ["guide" => $my_guide]);
    }

    public function update(Request $request, MyGuide $my_guide)
    {
        $guide_backup = new GuideBackup;
        $guide_backup->name = $my_guide->name;
        $guide_backup->description = $my_guide->description;
        $guide_backup->content = $my_guide->content; // TODO: protect against script tags
        $guide_backup->save();

        $my_guide->name = $my_guide->name;
        $my_guide->slug = Str::slug($my_guide->name, "-");
        $my_guide->description = $request->input("description");
        $my_guide->content = $request->input("content"); // TODO: protect against script tags
        $my_guide->save();
    }
}
