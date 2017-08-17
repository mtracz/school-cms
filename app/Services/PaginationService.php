<?php

namespace App\Services;

class PaginationService {

	protected $on_each_side;
	protected $max_page;
	protected $pagination_array = [];

	protected $page_number;

	public function __construct() {
		
	}

	public function getPaginationArray($items, $items_per_page, $page_number, $on_each_side = 2) {
		
		$this->on_each_side = $on_each_side;
		$this->page_number = $page_number;

		$items_count = $items->count();
		$this->setMaxPage($items_count, $items_per_page);

		if($this->page_number > $this->max_page) {
			$this->page_number = $this->max_page;
		}

		

		return pagination_array;
	}

	public function setMaxPage($items_count, $items_per_page) {
		
		$this->max_page = (int) ceil($items_count/$items_per_page);
	}

	public function getMaxPage() {
		
		return $this->max_page;
	}

}
