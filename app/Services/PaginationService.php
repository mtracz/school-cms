<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator as Paginator;

use App\Models\Settings;
use App\Models\News;

class PaginationService 
{

	protected $paginator;

	public function __construct() {

	}

	public function createPagination($items) {
		
		$paginator = $this->makePaginator($items);

		return $paginator;
	}

	public function makePaginator($items) {

		$total = count($items);
		$per_page = Settings::where("name","news_per_page")->first()->value;
		
		return new Paginator($items, $total, $per_page);
	}
}