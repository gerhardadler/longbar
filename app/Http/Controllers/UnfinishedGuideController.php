<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\UnfinishedGuide;
use App\GuideBackup;

class UnfinishedGuideController extends Controller
{
    public function edit(UnfinishedGuide $unfinished_guide)
    {
        $unfinished_guide["author"] = Auth::user()["name"];
        $unfinished_guide["is_new_guide"] = FALSE;
        return view("unfinished_guides.edit", ["guide" => $unfinished_guide]);
    }

    public function update(Request $request, UnfinishedGuide $unfinished_guide)
    {
        $guide_backup = new GuideBackup;
        $guide_backup->name = $unfinished_guide->name;
        $guide_backup->description = $unfinished_guide->description;
        $guide_backup->content = $unfinished_guide->content; // TODO: protect against script tags
        $guide_backup->save();

        $unfinished_guide->name = $unfinished_guide->name;
        $unfinished_guide->slug = Str::slug($unfinished_guide->name, "-");
        $unfinished_guide->description = $request->input("description");
        $unfinished_guide->content = $request->input("content"); // TODO: protect against script tags
        $unfinished_guide->save();
    }
}
