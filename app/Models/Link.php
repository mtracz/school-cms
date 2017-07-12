<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\MenuItem;

class Link extends Model
{
    protected $table = "links";

    public function menu_item() {
    	
    	$this->belongsTo(MenuItem::class);
    }
}
