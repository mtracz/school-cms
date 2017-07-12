<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Element;
use App\Models\MenuItem;

class Menu extends Model
{
    protected $table = "menu";

    public function element() {
    	
    	$this->hasMany(Element::class);
    }

    public function menu_item() {
    	
    	$this->hasMany(MenuItem::class);
    }
}
