<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\SiteSector;

class Orientation extends Model
{

	CONST HORIZONTAL = 1;
	CONST VERTICAL = 1;

    protected $table = "orientations";

    public function site_sector() {

    	return $this->hasMany(SiteSector::class);
    }
}
