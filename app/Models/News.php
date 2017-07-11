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
		
		$this->belongsTo(NewsCategory::class);
	}

	public function created_by() {

		$this->belongsTo(Admin::class);
	}

	public function news_pinned() {

		$this->hasOne(NewsPinned::class);
	}

}
