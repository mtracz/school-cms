<?php

namespace App\Services;

use App\Helpers\SectorHydratorHelper;

use App\Models\Element;
use App\Models\SiteSector;

class SectorHydratorService {

	protected $sectorHydratorHelper;

	public function __construct() {

		// $this->sectorHydratorHelper = new SectorHydratorHelper();
	}

	public function hydrateTop_1() {

		return Element::with(["panel.panel_type", "menu.menu_item.link", "site_sector.orientation"])->where("site_sector_id", SiteSector::TOP_1)->orderBy("site_sector_id", "asc")->orderBy("order", "asc")->get();
	}

	public function hydrateTop_2() {

		return Element::with(["panel.panel_type", "menu.menu_item.link", "site_sector.orientation"])->where("site_sector_id", SiteSector::TOP_2)->orderBy("site_sector_id", "asc")->orderBy("order", "asc")->get();

	}

	public function hydrateTop_3() {

		return Element::with(["panel.panel_type", "menu.menu_item.link", "site_sector.orientation"])->where("site_sector_id", SiteSector::TOP_3)->orderBy("site_sector_id", "asc")->orderBy("order", "asc")->get();

	}

	public function hydrateLeft() {

		return Element::with(["panel.panel_type", "menu.menu_item.link", "site_sector.orientation"])->where("site_sector_id", SiteSector::LEFT)->orderBy("site_sector_id", "asc")->orderBy("order", "asc")->get();

	}

	public function hydrateRight() {

		return Element::with(["panel.panel_type", "menu.menu_item.link", "site_sector.orientation"])->where("site_sector_id", SiteSector::RIGHT)->orderBy("site_sector_id", "asc")->orderBy("order", "asc")->get();

	}

	public function hydrateBottom() {

		return Element::with(["panel.panel_type", "menu.menu_item.link", "site_sector.orientation"])->where("site_sector_id", SiteSector::BOTTOM)->orderBy("site_sector_id", "asc")->orderBy("order", "asc")->get();

	}
}