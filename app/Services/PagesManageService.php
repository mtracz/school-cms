<?php

namespace App\Services;

use App\Models\StaticPage;
use App\Models\Admin;

class PagesManageService {


	public function pluckPages($request) {
		
		$params = $this->prepareParametersArray($request);

		$pages_plucked = StaticPage::where($params)->get();

		if($pages_plucked->toArray() == []) {
			return null;
		} else {
			return $pages_plucked;
		}
		
	}

	protected function prepareParametersArray($parameters) {
		
		$query_array;

		$is_public = $this->isStatusPublic($parameters["status"]);
		$admin_id = $this->getAdminId($parameters["author"]);

		$query_array = [];

		$query_array = [
			["created_at", "like", $parameters["created_at_date_parsed"] . "%"],
			["updated_at", "like", $parameters["updated_at_date_parsed"] . "%"],
			["title", "like", "%" . $parameters["title"] . "%"],
			["created_by", "=", $admin_id],
			["is_public", "=", $is_public],
		];

		$count = count($query_array);

		for($i = 0; $i < $count; $i++) {

			// if( strpos($query_array[$i][2], "%") ) {
			$temp_str = str_replace("%", "", $query_array[$i][2]);

			// $temp_str = str_replace("%%", "", $query_array[$i][2]);
			// }
			
			if($temp_str == "") {

				unset($query_array[$i]);
			}
		}

		$array = [];
		
		foreach($query_array as $item) {
			array_push($array, $item);
		}

		return $array;
	}

	public function isStatusPublic($status) {
		if($status != null) {
			if($status == "public") {
				return 1;
			} else { 
				if($status == "private") {
					return 0;
				}
			}
		} else {
			return $status;
		}
		
	}

	public function getAdminId($name) {

		$id = Admin::where("name", "=", $name)->get();

		if($id->isEmpty()) {
			return null;
		} else {
			$id = $id->toArray()[0]["id"];
		}

		return $id;
	}
}