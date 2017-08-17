<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\SettingsService;
use App\Services\PasswordService;

use Session;

class SettingsController extends Controller
{
	public function getSettings() {
		
		$settingsService = new SettingsService();

		$settingsData = $settingsService->getSettingsData();

		return $settingsData;
	}

	public function setSettings(Request $request) {
		
		$settingsService = new SettingsService();

		$settingsService->saveSettingsDataToDB($request->all());
	}

	public function changePassword(Request $request) {

		$passwordService = new PasswordService();

		$requestData = $request->all();

		$admin_id = $request["admin_id"];
		$admin_old_password = $request["old_password"];
		$admin_new_password = $request["new_password"];
		$admin_new_password_confirm = $request["new_password_confirm"];

		$errors = [];

		if( $passwordService->checkOldPassword($admin_id, $admin_old_password) 
			&& $passwordService->checkConfirmPassword($admin_new_password, $admin_new_password_confirm)) {

			$passwordService->setPassword($admin_id, $admin_new_password);
		} else {

			return response(["password_change" => "error"]);
		}
	}
}