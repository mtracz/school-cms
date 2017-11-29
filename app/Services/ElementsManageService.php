<?php 

namespace App\Services;

use App\Models\Link;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Element;


class ElementsManageService {

	protected $tabs_quantity = 0;
	protected $elements_quantity_in_each_tab = []; //first tab on index '0'
	protected $data_tab_for_tabs = []; //first tab on index '0'
	protected $sector_id;
	protected $menu_name;
	protected $menu_id;
	protected $is_menu_saved = false;
	protected $is_menu_deleted = false;

	protected $request_data;
	

	public function prepareMenuData($request) {	
		// dd($request);
		$this->request_data = $request;

		$this->tabs_quantity = $request["tabs_count"];
		$this->sector_id = $request["sector_id"];
		$this->menu_name = $request["menu_name"];

		$this->elements_quantity_in_each_tab = explode(",", $request["elements_in_tabs"]);

		$this->data_tab_for_tabs = explode(",", $request["data_tabs"]);

		return $this;
	}

	public function buildMenu($editing_mode = false, $menu_id = null) {
		
		if($editing_mode) {
			$menuObject = Menu::find($menu_id);
			$current_menu_order = $menuObject->element->order;
			$this->deleteMenuFromDatabase($menu_id);
		}

		$this->createMenuInDatabase($this->menu_name);

		foreach ($this->elements_quantity_in_each_tab as $tab => $value) {
			// create item in menu
			$menuItemObject = new MenuItem();
			$menuItemObject->order = $tab + 1;
			$menuItemObject->menu_id = $this->menu_id;

			if($value > 1) {
				// more than one element in tab(item)
				$menuItemObject->name = $this->request_data["item_name_tab_" . $this->data_tab_for_tabs[$tab]];
				$menuItemObject->is_dropdown = true;
			} else {
				// exactly one element in tab(item)
				$menuItemObject->name = $this->request_data["element_name_tab_" . $this->data_tab_for_tabs[$tab] . "_1"];
				$menuItemObject->is_dropdown = false;
			}
			$menuItemObject->save();

			// add link to menu item
			for($i = 0; $i < $value; $i++) {
				$order = $i + 1;

				$linkObject = new Link();
				$linkObject->name = $this->request_data["element_name_tab_" . $this->data_tab_for_tabs[$tab] . "_" . $order];
			
				$domain = route("index.get");
				$url = $this->request_data["element_url_tab_" . $this->data_tab_for_tabs[$tab] . "_" . $order];

				if(strpos($url, $domain) !== false) {			    
				    $linkObject->url = $url;
				} else {
					//  // - redirect to other site					
					$linkObject->url = "//" . $url;
				}
		
				$linkObject->order = $order;
				$linkObject->menu_item_id = $menuItemObject->id;
				$linkObject->save();
			}
		}
		if($editing_mode) {
			$this->addMenuToElements($current_menu_order);
		} else {
			$this->addMenuToElements();
		}
	}

	protected function createMenuInDatabase($menu_name) {
		$menuObject = new Menu();
		$menuObject->name = $menu_name;
		$menuObject->save();

		$this->menu_id = $menuObject->id;
	}

	protected function addMenuToElements($current_menu_order = null) {

		$quantity_elements_in_sector = Element::where("site_sector_id", $this->sector_id)->count();

		$elementObject = new Element();
		$elementObject->site_sector_id = $this->sector_id;
		$elementObject->order = $current_menu_order ?? $quantity_elements_in_sector + 1;
		$elementObject->menu_id = $this->menu_id;
		$elementObject->is_enabled = true;
		$elementObject->save();

		$this->is_menu_saved = true;
	}

	public function isMenuSaved() {
		return $this->is_menu_saved;
	}


	public function deleteMenuFromDatabase($id) {
		$menuObject = Menu::find($id);
		if($menuObject) {

			$menu_items = $menuObject->menu_item;

			foreach ($menu_items as $item_key => $item_value) {
				$links_form_menu_item = $menu_items[$item_key]->link;

				// delete links for current menu item
				foreach ($links_form_menu_item as $link_key => $link_value) {
					Link::find($link_value["id"])->delete();
				}
				// delete menu item
				MenuItem::find($item_value["id"])->delete();

			}

			// delete menu id from elements
			Element::where("menu_id", $id)->delete();

			// delete menu
			$menuObject->delete();
			$this->is_menu_deleted = true;
		} else {
			$this->is_menu_deleted = false;
		}
	}

	public function isMenuDeleted() {
		return $this->is_menu_deleted;
	}


}