<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnfinishedGuide extends Model
{
    public $timestamps = false;

    public function getRouteKeyName() {
        return "slug";
    }
}
