<?php

namespace App\Services;

use Illuminate\Http\Request;

class PaginationService {

	protected $on_each_side;
	protected $max_page;
	protected $pagination_array = [];

	protected $page_number = 1;
	protected $parameters;

	protected $first_page = 1;
	protected $last_page;
	protected $next_page;
	protected $prev_page;

	public function __construct(Request $request, $items, $items_per_page, $on_each_side = 2) {
		$this->parameters = $request->all();
		$this->on_each_side = $on_each_side;
		$this->setPageNumber();

		$items_count = $items->count();
		$this->setMaxPage($items_count, $items_per_page);

		$this->checkIfPageNumberOverMaxPage();
		$this->preparePaginationArray();

		$this->setLastPage();
		$this->setNextPage();
		$this->setPrevPage();
	}

	public function preparePaginationArray() {

		$pagination_array = [];

		for($i = $this->page_number - $this->on_each_side; $i < $this->page_number + $this->on_each_side + 1; $i++) {

			if($i >= 1 && $i <= $this->max_page) {
				array_push($pagination_array, $i);
			}
		}

		$this->pagination_array = $pagination_array;	
	}

	public function getPaginationArray() {
		return $this->pagination_array;
	}

	public function setPageNumber() {
		if(isset($this->parameters["page"])) {
			$this->page_number = (int) $this->parameters["page"];
		}
	}

	public function getPageNumber() {
		return $this->page_number;
	}

	public function checkIfPageNumberOverMaxPage() {
		if($this->page_number > $this->max_page) {
			$this->page_number = $this->max_page;
		}
	}

	public function setMaxPage($items_count, $items_per_page) {
		
		$this->max_page = (int) ceil($items_count/$items_per_page);
	}

	public function getMaxPage() {
		
		return $this->max_page;
	}

	public function getFirstPage() {
		
		return $this->first_page;
	}

	public function setLastPage() {
		$this->last_page = $this->max_page;
	}

	public function getLastPage() {
		
		return $this->last_page;
	}

	public function setNextPage() {
		
		$this->next_page = $this->page_number + 1;
	}
	
	public function getNextPage() {
		
		return $this->next_page;
	}

	public function setPrevPage() {
		
		$this->prev_page = $this->page_number - 1;
	}

	public function getPrevPage() {
		
		return $this->prev_page;
	}

}
