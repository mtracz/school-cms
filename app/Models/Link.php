<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\MenuItem;

class Link extends Model
{
    protected $table = "links";
    public $timestamps = false;

    public function menu_item() {
    	
    	return $this->belongsTo(MenuItem::class);
    }
}
