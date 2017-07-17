<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Element;

class SiteSector extends Model
{

	const TOP_1 = 1;
	const TOP_2 = 2;
	const TOP_3 = 3;
	const LEFT = 4;
	const RIGHT = 5;
	const BOTTOM = 6;

    protected $table = "site_sectors";

    public function element() {

    	return $this->hasMany(Element::class);
    }
}
