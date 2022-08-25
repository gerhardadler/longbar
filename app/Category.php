<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function getRouteKeyName() {
        return "slug";
    }
    
    protected $table = 'categories';
    public $timestamps = false;

    public function guides() {
        return $this->belongsToMany('App\Guide')->withTimestamps();
    }
}
