<?php 

namespace App\Services;

use App\Models\Settings;

use Session;

class SettingsService {

	protected $is_maintenance_mode = false; //unchecked

	public function getSettingsData() {

		$settings = Settings::all()->toArray();	

		$settings_data = [];

		foreach ($settings as $settings_key => $setting) {
			$settings_data[$setting["name"]] = $setting["value"];
		}

		return $settings_data;
	}

	public function saveSettingsDataToDB($request) {

		foreach($request as $key => $value) {

			if(!is_null($value)) {

				$settings = Settings::where("name", "=", $key)->first();
				if($settings) {
					if($key == "is_maintenance_mode" && $value == "on") {
						$settings->value = 1;
					} else {
						$settings->value = $value;						
					}
					$settings->save();	
				}
			}
		}
	}
}