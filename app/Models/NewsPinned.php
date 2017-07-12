<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\News;

class NewsPinned extends Model
{
    protected $table = "news_pinned";

    public function news() {

    	$this->belongsTo(News::class);
    	
    }

}
