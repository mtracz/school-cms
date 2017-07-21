<?php

namespace App\Helpers;

use App\Models\Element;
use App\Models\SiteSector;

class SectorHydratorHelper {

	protected $elements;

	public function __construct() {
		
		$this->elements = Element::orderBy("order", "asc")->get();
	}

	public function getElementsTop_1() {

		return $this->getMatchedElements(SiteSector::TOP_1);
	}

	public function getElementsTop_2() {

		return $this->getMatchedElements(SiteSector::TOP_2);
	}

	public function getElementsTop_3() {

		return $this->getMatchedElements(SiteSector::TOP_3);
	}

	public function getElementsLeft() {

		return $this->getMatchedElements(SiteSector::LEFT);
	}

	public function getElementsRight() {

		return $this->getMatchedElements(SiteSector::RIGHT);
	}

	public function getElementsBottom() {

		return $this->getMatchedElements(SiteSector::BOTTOM);
	}

	public function getMatchedElements($sector_id) {

		$array = [];

		foreach ($this->elements as $element) {

			if( $element->site_sector->id == $sector_id ) {

				array_push($array, $element->toArray());
			}
		}

		return $array;
	}
	
}