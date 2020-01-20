<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function storage(){
    	//create a link with items table
    	return $this->belongsToMany("\App\Storage");
    }

    public function status(){
    	return $this->belongsTo('App\Status');
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
