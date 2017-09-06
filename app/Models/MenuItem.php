<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Menu;
use App\Models\Link;

class MenuItem extends Model
{
    protected $table = "menu_items";
    public $timestamps = false;

    public function menu() {
    	
    	return $this->belongsTo(Menu::class);
    }

    public function link() {
    	
    	return $this->hasMany(Link::class);
    }
}
