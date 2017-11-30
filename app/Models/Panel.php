<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Element;
use App\Models\PanelType;

class Panel extends Model
{
    protected $table = "panels";

    public $timestamps = false;

    public function element() {
    	return $this->hasMany(Element::class);
    }

    public function panel_type() {
    	return $this->belongsTo(PanelType::class);
    }
}
