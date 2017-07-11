<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Element;
use App\Models\PanelType;

class Panel extends Model
{
    protected $table = "panels";

    public function element()
    {
    	$this->hasMany(Element::class);
    }

    public function panel_type()
    {
    	$this->belongsTo(PanelType::class);
    }
}
