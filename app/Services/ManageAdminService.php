<?php 

namespace App\Services;

use Validator;

use App\Models\Admin;

class ManageAdminService {

	protected $adminData = [
		"name" => "",
		"login" => "",
		"password" => "",
		"is_active" => "",
	];

	protected $is_active = false; //unchecked

	protected $is_admin_deleted = false;
	protected $isValidated = false;
	protected $errors = [];
	protected $errorMessages = [];

	public function setAdminData($request) {
		$this->adminData["name"] = $request["name"];
		$this->adminData["login"] = $request["login"];
		$this->adminData["password"] = $request["password"];
		$this->adminData["is_active"] = $request["is_active"];
		
		$this->checkCheckboxes();

		return $this;
	}

	protected function checkCheckboxes() {
		if($this->adminData["is_active"] === "true") {
			$this->is_active = true;
		}
	}

	public function saveAdmin() {

		$this->validateData();
		if(!$this->isValidated) {
			return false;
		}

		$adminObject = new Admin();
		$adminObject->name = $this->adminData["name"];
		$adminObject->login = $this->adminData["login"];
		$adminObject->password = bcrypt($this->adminData["password"]);
		$adminObject->is_super_admin = 0;
		$adminObject->is_active = $this->is_active;
		$adminObject->save();

		//LogService::add("admin: " . $this->adminData["login"]);
	}

	public function updateAdmin($id) {

		$adminObject = Admin::find($id);
		if($adminObject) {

			$uniqueAdminLogin = Admin::where("id", "!=", $id)->where("login", $this->adminData["login"])->first();
			$uniqueAdminName = Admin::where("id", "!=", $id)->where("name", $this->adminData["name"])->first();		

			if($uniqueAdminLogin) {
				array_push($this->errors, "Podaj inny login ");
				return false;
			}
			if($uniqueAdminName) {
				array_push($this->errors, "Podaj inną nazwę ");
				return false;
			}

			$adminObject->name = $this->adminData["name"];
			$adminObject->login = $this->adminData["login"];
			if(isset($this->adminData["password"]))
				$adminObject->password = bcrypt($this->adminData["password"]);
			if(!Admin::where("id", $id)->where("is_super_admin", true)) //check editing admin is super admin
				$adminObject->is_super_admin = 0;
			$adminObject->is_active = $this->is_active;
			$adminObject->save();

			//LogService::edit("admin: " . $this->adminData["login"]);	
		} else {
			array_push($this->errors, "Nie znaleziono administratora o podanym id");
		}
	}

	public function deleteAdminFromDB($admin_id) {
		$deletedAdmin = Admin::find($admin_id);

		if($deletedAdmin) {
			// LogService::delete("admin: " . $deletedAdmin->login);
			$deletedAdmin->delete();
			$this->is_admin_deleted = true;
		}
	}

	protected function getValidateRules() : array {
		$rules = [
			"name"	=> "required|min:6|unique:admins",
			"login"	=> "required|min:6|unique:admins",
			"password" => "required|min:6",
			];

		$this->errorMessages = [
			"name.required" => "Pole nazwa jest wymagane",
			"name.min" => "Nazwa musi mieć min. 6 znaków",
			"name.unique" => "Podaj inną nazwę",
			"login.required" => "Pole login jest wymagane",
			"login.min" => "Login musi mieć min. 6 znaków",
			"login.unique" => "Podaj inny login",
			"password.min" => "Hasło musi mieć min. 6 znaków",
			"password.required" => "Pole hasło jest wymagane",
		];
		return $rules;
	}

	protected function validateData() {
		$validator = Validator::make($this->adminData, $this->getValidateRules(), $this->errorMessages);
			if($validator->passes()) {
				$this->isValidated = true;
			} else {
				$this->validateErrors = $validator->errors();
				foreach ($this->validateErrors->all() as $message) {
					array_push($this->errors, $message);
				}
				$this->isValidated = false;
			}
	}

	public function isDeleted() {
		return $this->is_admin_deleted;
	}

	public function getErrors() {
		return $this->errors;
	}
}