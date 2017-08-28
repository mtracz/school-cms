<?php

namespace App\Services;

use App\Models\Admin;
use App\Http\Controllers\FileController;

class FilesManageService {


	public function pluckFiles($request) {
		
		$params = $this->prepareParametersArray($request);

		$fileController = new FileController();
		$allFiles = json_decode($fileController->getAllFilesFromServer());

		$files_plucked = [];

		if($params != null) {
			foreach($allFiles as $file_key => $file_value) {

				$compareSearchWithFileName = strpos($file_value, $params[0]["name"]);

				if($compareSearchWithFileName !== false) {
					
					array_push($files_plucked, $file_value);
				}
			}

			return $files_plucked;
		} else {
			return null;
		}
		
	}

	protected function prepareParametersArray($parameters) {

		$query_array = [];

		$query_array = [
			["name" => $parameters["name"]],
		];

		$count = count($query_array);

		for($i = 0; $i < $count; $i++) {
			
			if($query_array[$i]["name"] == "") {

				unset($query_array[$i]);
			}
		}

		// $array = [];
		$array = $query_array;
		
		// foreach($query_array as $item) {
		// 	array_push($array, $item);
		// }

		return $array;
	}
}