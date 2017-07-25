<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\NewsCategory;
use App\Models\Admin;
use App\Models\NewsPinned;

class News extends Model
{
	protected $table = "news";

	public function news_category() {
		
		return $this->belongsTo(NewsCategory::class);
	}

	public function admin() {

		return $this->belongsTo(Admin::class, "created_by");
	}

	public function news_pinned() {

		return $this->hasOne(NewsPinned::class);
	}

}
