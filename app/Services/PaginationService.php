<?php

namespace App\Services;

class PaginationService {

	protected $on_each_side = 2;
	protected $max_page;
	protected $paginator_array = [];

	public function preparePaginatorArray($news, $news_per_page_value, $page_number) {

		$news_count = $news->count();
		$max_page = $this->setMaxPage($news_count, $news_per_page_value);

		if($page_number > $this->max_page) {
			$page_number = $this->max_page;
		}

		$news = $news->forPage($page_number, $news_per_page_value);

		$paginator_array = [];
		for($i = $page_number - $this->on_each_side; $i < $page_number + $this->on_each_side + 1; $i++) {

			if($i >= 1 && $i <= $this->max_page) {
				array_push($paginator_array, $i);
			}
		}

		return $paginator_array;
	}

	protected function setMaxPage($items_count, $items_per_page) {
		
		$this->max_page = (int) ceil($items_count/$items_per_page);
	}

	public function getMaxPage() {
		
		return $this->max_page;
	}
	
}
