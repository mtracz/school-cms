<?php 

namespace App\Services;

use App\Models\Settings;

use Session;

class SettingsService {

	public function getSettingsData() {

		$settings = Settings::all()->toArray();	

		$settings_data = [];

		foreach ($settings as $settings_key => $setting) {
			$settings_data[$setting["name"]] = $setting["value"];
		}

		return $settings_data;
	}

	public function saveSettingsDataToDB($request) {
		
		Session::flash("settingsFormData", $request);

		foreach($request as $key => $value){

			Session::flash("Request key", $key);
			Session::flash("Request value", $value);

			if(!is_null($value)) {
				$settings = Settings::where("name", "=", $key)->first();
				if($settings) {
					$settings->value = $value;
					$settings->save();
				}
				
			}
		}
	}
}