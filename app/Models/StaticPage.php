<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Admin;

class StaticPage extends Model
{
    protected $table = "static_pages";

    public function admin() {
    	
    	return $this->belongsTo(Admin::class, "created_by");
    }
}
