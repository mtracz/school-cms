<?php

namespace App\Services;

use App\Models\Element;

class SectorHydratorService {

	public function getElementsData() {

		return Element::all();
	}

	public function hydrateTop_1() {

		$elements = $this->getElementsData();

		dd($elements);
	}

	public function hydrateTop_2() {

		
	}

	public function hydrateTop_3() {

		
	}

	public function hydrateLeft() {

		
	}

	public function hydrateContent() {

		
	}

	public function hydrateRight() {

		
	}

	public function hydrateBottom() {

		
	}
}