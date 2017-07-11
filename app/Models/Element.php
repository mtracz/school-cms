<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Panel;
use App\Models\Menu;
use App\Models\SiteSector;

class Element extends Model
{
    protected $table = "elements";

    public function panel() {
    	
    	$this->belongsTo(Panel::class);
    }

    public function menu() {
    	
    	$this->belongsTo(Menu::class);
    }

    public function site_sector() {
    	
    	$this->belongsTo(SiteSector::class);
    }
}
