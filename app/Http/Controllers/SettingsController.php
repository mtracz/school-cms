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

		if(!$settingsService->isUserNameUpdated()) {
			return response(["status" => "error",
							"message" => "Nie zmieniono nazwy użytkownika, już istnieje taka nazwa."]);
		}

	}

	public function changePassword(Request $request) {

		$passwordService = new PasswordService();

		// $requestData = $request->all();

		$admin_id = $request["admin_id"];
		$admin_old_password = $request["old_password"];
		$admin_new_password = $request["new_password"];
		$admin_new_password_confirm = $request["new_password_confirm"];

		$errors = [];

		if( !$passwordService->checkOldPassword($admin_id, $admin_old_password ) ) {
			array_push($errors, "Stare hasło jest niepoprawne!");
		}

		if( !$passwordService->checkConfirmPassword($admin_new_password, $admin_new_password_confirm) ) {
			array_push($errors, "Nowe i powtórzone hasła są różne!");
		}

		if( strlen($admin_new_password) < 6 ) {
			array_push($errors, "Nowe hasło MUSI zawierać min. 6 znaków");
		}

		// FIX password_change response !

		if( empty($errors) ) {

			$passwordService->setPassword($admin_id, $admin_new_password);

			return response(["password_change" => "success"]);
		} else {

			$response_array = [
				"password_change" => "error",
				"errors" => $errors,
			];

			return response($response_array);
		}
	}
}