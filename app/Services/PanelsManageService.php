<?php 

namespace App\Services;

use App\Models\Panel;
use App\Models\Element;

class PanelsManageService {

	protected $panel_data = [];

	protected $added_panel_id;
	protected $panel_deleted = false;
	protected $panel_saved = false;


	public function preparePanelData($request) {
		
		$this->panel_data["name"] = $request["name"];
		$this->panel_data["header"] = $request["header"];
		$this->panel_data["content"] = $request["content"];
		$this->panel_data["sector_id"] = $request["sector_id"];
		$this->panel_data["panel_type_id"] = $request["panel_type_id"];

		return $this;
	}

	public function addPanelToDatabase() {
		$panel = new Panel();
		$panel->name = $this->panel_data["name"];
		if(strlen($this->panel_data["header"]) > 0) {
			$panel->header = $this->panel_data["header"];
			$panel->has_header = 1;
		} else 
			$panel->has_header = 0;

		$panel->content = $this->panel_data["content"];
		$panel->panel_type_id = $this->panel_data["panel_type_id"];
		$panel->save();

		$this->added_panel_id = $panel->id;

		return $this;
	}

	public function addElementInDatabase() {
		$element = new Element();
		$element->site_sector_id = $this->panel_data["sector_id"];
		$element->panel_id = $this->added_panel_id;
		$element->order = $this->checkOrderInSector($this->panel_data["sector_id"]) + 1;
		$element->is_enabled = 1;
		$element->save();

		$this->panel_saved = true;
	}

	protected function checkOrderInSector($sector_id) {
		$site_sector_max_order = Element::where("site_sector_id", $sector_id)->max("order");		
		return $site_sector_max_order;
	}

	public function deletePanelFromDatabase($id) {
		$panel = Panel::find($id);
		$element = Element::where("panel_id", $id)->first();
		if($panel && $element) {
			$element->delete();
			$panel->delete();			
			$this->panel_deleted = true;
		}
	}

	public function isPanelDeleted() {
		return $this->panel_deleted;
	}

	public function isPanelSaved() {
		return $this->panel_saved;
	}
	

}