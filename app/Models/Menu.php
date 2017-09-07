<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Element;
use App\Models\MenuItem;

class Menu extends Model
{
    protected $table = "menu";
    public $timestamps = false;

    public function element() {
    	
    	return $this->hasOne(Element::class);
    }

    public function menu_item() {
    	
    	return $this->hasMany(MenuItem::class);
    }
}
