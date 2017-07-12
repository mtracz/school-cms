<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Element;

class SiteSector extends Model
{
    protected $table = "site_sectors";

    public function element() {

    	$this->hasMany(Element::class);
    }
}
