<?php 

namespace App\Services;

use App\Models\Settings;
use App\Models\Admin;

use Auth;
use Session;

class SettingsService {

	protected $userNameUpdated = false;

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
		//change admin name
		$user_name = $request["admin_name"];
		$user = Admin::where("id", "!=", Auth::user()->id)->where("name", $user_name)->first();
		if(!$user) {
			if(Auth::user()->name != $user_name) {
				$admin = Admin::find(Auth::user()->id);
				$admin->name = $user_name;
				$admin->save();
			}
			$this->userNameUpdated = true;		
		}
	}

	public function isUserNameUpdated() {
		return $this->userNameUpdated;
	}
}