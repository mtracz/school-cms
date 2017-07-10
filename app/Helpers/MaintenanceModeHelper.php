<?php

namespace App\Helpers;

use App\Models\Settings;

use DB;

class MaintenanceModeHelper {

	public function isMaintenance() : bool {

		$isMaintenance = DB::table("settings")->where("name", "is_maintenance_mode", 1)->pluck("value")->toArray();
		
		if($isMaintenance[0]) {
			return true;
		} else {
			return false;
		}
	}	
}
