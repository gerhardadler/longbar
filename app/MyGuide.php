<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyGuide extends Model
{
    public $timestamps = false;

    public function getRouteKeyName() {
        return "slug";
    }
}
