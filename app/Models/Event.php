<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Admin;

class Event extends Model
{
    protected $table = "events";

    public function created_by() {
    	
    	$this->belongsTo(Admin::class);
    }
}

