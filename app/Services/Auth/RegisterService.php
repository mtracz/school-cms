<?php 

namespace App\Services\Auth;

use Validator;

use App\Models\Admin;
use App\Models\Settings;

class RegisterService {

	protected $registerData = [];
	protected $isDataSet = false;
	protected $errorMessages = [];
	protected $errors = [];
	protected $isValidated = false;
	protected $isRegistered = false;

	public function setRegisterData($request) {
		$this->registerData = [
			"name" => $request["name"],
			"login" => $request["login"],
			"password" => $request["password"],
			"password_confirmation" => $request["password_confirmation"],
			"email" => $request["email"],
		];
		$this->isDataSet = true;
		return $this;
	}

	protected function getValidateRules() : array {	
		$rules = [
			"name"	=> "required|min:6|unique:admins",
			"login"	=> "required|min:6|unique:admins",
			"email"	=> "required|email|max:50",
			"password" => "required|min:6|required|confirmed",
			];		

		$this->errorMessages = [
			"name.required" => "Pole nazwa jest wymagane",
			"name.min" => "Nazwa musi mieć min. 6 znaków",
			"name.unique" => "Podaj inną nazwę",
			"login.required" => "Pole login jest wymagane",
			"login.min" => "Login musi mieć min. 6 znaków",
			"login.unique" => "Podaj inny login",
			"email.required" => "Pole email jest wymagane",
			"email.max" => "Email może mieć max. 50 znaków",
			"email.email" => "Podaj porawny email",
			"email.unique" => "Podaj inny email",
			"password.min" => "Hasło musi mieć min. 6 znaków",
			"password.confirmed" => "Hasła się nie zgadzają",
			"password.required" => "Pole hasło jest wymagane",
		];
		return $rules;
	}

	public function validate() {
		if($this->isDataSet) {
			$validator = Validator::make($this->registerData, $this->getValidateRules(), $this->errorMessages);
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
		return $this;
	}

	public function registerSuperAdmin() {
		if($this->isValidated) {
			$admin = new Admin();
			$admin->name = $this->registerData["name"];
			$admin->login = $this->registerData["login"];
			$admin->password = bcrypt($this->registerData["password"]);
			$admin->is_super_admin = 1;
			$admin->is_active = 1;
			$admin->save();

			$settings = Settings::where("name", "admin_email")->first();
			$settings->value = $this->registerData["email"];
			$settings->save();
			
			$this->isRegistered = true;
		} else {
			$this->isRegistered = false;
		}
	}

	public function getErrors() {
		return $this->errors;
	}

	public function registerStatus() {
		return $this->isRegistered;
	}
}