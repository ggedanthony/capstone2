<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function storages(){
    	return $this->hasMany("\App\Storage");
    }
}
