<?php 

namespace App\Services;

use DB;

use App\Models\Settings;

class SettingsService {

	public function getSettingsData() {
			
		$settings = Settings::all()->toArray();	

		$settings_data = [];

		foreach ($settings as $settings_key => $setting) {
			$settings_data[$setting["name"]] = $setting["value"];
		}

		return $settings_data;
	}
}