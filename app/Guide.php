<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    public function categories() {
        return $this->belongsToMany('App\Category')->withTimestamps();
    }
}
