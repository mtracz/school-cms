<?php

namespace App\Services;

use App\Helpers\SectorHydratorHelper;

use App\Models\Element;
use App\Models\News;
use App\Models\Settings;
use App\Models\SiteSector;

class SectorHydratorService {

	protected $sectorHydratorHelper;

	public function __construct() {

		$this->sectorHydratorHelper = new SectorHydratorHelper();
	}

	public function hydrateTop_1() {

		return Element::where("site_sector_id", SiteSector::TOP_1)->orderBy("site_sector_id", "asc")->orderBy("order", "asc")->get();

		$elements = $this->sectorHydratorHelper->getElementsTop_1();
	}

	public function hydrateTop_2() {

		$elements = $this->sectorHydratorHelper->getElementsTop_2();
	}

	public function hydrateTop_3() {

		$elements = $this->sectorHydratorHelper->getElementsTop_3();
	}

	public function hydrateLeft() {

		$elements = $this->sectorHydratorHelper->getElementsLeft();
	}

	public function hydrateRight() {

		$elements = $this->sectorHydratorHelper->getElementsRight();
	}

	public function hydrateBottom() {

		$elements = $this->sectorHydratorHelper->getElementsBottom();
	}
}