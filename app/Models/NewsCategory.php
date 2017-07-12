<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\News;

class NewsCategory extends Model
{
    protected $table = "news_categories";

    public function news() {
    	
    	$this->hasMany(News::class);
    }

}
