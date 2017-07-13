<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Admin;

class StaticPage extends Model
{
    protected $table = "static_pages";

    public function created_by() {
    	
    	return $this->belongsTo(Admin::class);
    }
}
