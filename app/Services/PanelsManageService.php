<?php 

namespace App\Services;

use File;

use App\Models\Panel;
use App\Models\Element;
use App\Services\ImageService;

class PanelsManageService {

	protected $panel_data = [];

	protected $added_panel_id;
	protected $panel_deleted = false;
	protected $panel_saved = false;
	protected $errors = [];

	protected $images_src = [];
	protected $panels_dir = "images/panels/";


	public function preparePanelData($request, $id = null) {
		
		$this->panel_data["name"] = $request["name"];
		$this->panel_data["header"] = $request["header"];
		$this->panel_data["content"] = $request["content"];
		$this->panel_data["sector_id"] = $request["sector_id"];
		$this->panel_data["panel_type_id"] = $request["panel_type_id"];
		$this->panel_data["element_id"] = $id;

		$this->images_src = json_decode($request['json_images_src']);

		return $this;
	}

	public function addPanelToDatabase() {

		if($this->images_src) {
			// $this->prepareNewsDir();
			$this->createPanelsDir($this->panels_dir);
			$this->changeImagesSrcInContent();
			$imageService = new ImageService();
			$imageService->moveImagesFromTemp($this->images_src, $this->panels_dir);
		}

		$panel = new Panel();
		$panel->name = $this->panel_data["name"];
		$this->checkHeader($panel, $this->panel_data["header"]);
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

	protected function checkHeader($panel, $header) {
		if(strlen($header) > 0) {
			$panel->header = $header;			
			$panel->has_header = 1;
		} else {
			$panel->header = null;
			$panel->has_header = 0;
		}
	}

	public function updatePanelInDatabase() {
		if($this->checkIsPanelNameUnique($this->panel_data["name"], $this->panel_data["element_id"])) {
			$panel = Panel::find($this->panel_data["element_id"]);
			if($panel) {



				$panel->name = $this->panel_data["name"];
				$this->checkHeader($panel, $this->panel_data["header"]);
				$panel->content = $this->panel_data["content"];
				$panel->save();
				$this->panel_saved = true;
			} else 
				array_push($this->errors, "Nie znaleziono panelu o danym ID");
		} else {
			array_push($this->errors, "Nazwa panelu jest już zajęta, podaj inną.");
		}
	}

    protected function checkIsPanelNameUnique($panel_name, $panel_id) {
    	$panel = Panel::where("name", $panel_name)->where("id", "!=", $panel_id)->first();
    	if($panel) {
    		return false;
    	}
    	return true;
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

	public function getErrors() {
		return $this->errors;
	}
	

	protected function createPanelsDir($dir) {
		File::makeDirectory("./" . $dir, 0755, true, true);
	}

	protected function changeImagesSrcInContent() {
		$this->panel_data["content"] = str_replace("images/temp/", $this->panels_dir, $this->panel_data["content"]);
	}

}