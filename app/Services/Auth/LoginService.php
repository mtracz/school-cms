<?php

namespace App\Services\Auth;

use Auth;
use Carbon\Carbon;
use Validator;

use App\Models\Admin;


class LoginService {

	protected $userData;
	protected $isValidated = false;
	protected $errors = [];
	protected $logged = false;
	protected $errorMessages = [];
	protected $validateErrors;
	protected $userObject;

	public function setData($request) {
		$this->userData = [
			"login" => $request["login"],
			"password" => $request["password"],
		];
		return $this;
	}

	public function getLoginData() {
		return $this->userData;
	}

	public function getValidateRules() {
		$rules = [
			"login"    => "required",
			"password" => "required",
		];
		$this->errorMessages = [
			"login.required" => "Login jest wymagany",		
			"password.required" => "Hasło jest wymagane",
		];
		return $rules;
	}

	public function validate() {
		$validator = Validator::make($this->getLoginData(), $this->getValidateRules(), $this->errorMessages);
		if($validator->passes()) {
			$this->isValidated = true;				
		}
		else {
			$this->validateErrors = $validator->errors();
			foreach ($this->validateErrors->all() as $message) {
					array_push($this->errors, $message);
			}
			$this->isValidated = false;			
		}
		return $this;
	}

	public function login() {
		$this->userObject = Admin::where("login", $this->userData["login"])->first();
		if($this->isValidated && $this->userObject) {
			if(! $this->userObject->is_active()) {
				$this->logged = false;
				array_push($this->errors, "Użytkownik jest nie aktywowany");
				return $this;
			}
			if(Auth::attempt($this->userData)) {
				$this->logged = true;
			} else {
				$this->logged = false;
				if(empty($this->errors)) {
					array_push($this->errors, "Niepoprwane dane logowania");
				}
			}	
		} else {
			$this->logged = false;
			if(empty($this->errors)) {
					array_push($this->errors, "Niepoprwane dane logowania");
			}
		}
		return $this;
	}

	public function getErrors() {
		return $this->errors;
	}

	public function isLogged() {
		return $this->logged;
	}

}