<?php 

namespace App\Services;

use App\Models\Admin;

use Hash;
use Auth;

class PasswordService {

	public function setPassword($admin_id, $password) {

		$admin = Admin::find($admin_id);

		$admin->password = bcrypt($password);
		$admin->save();
	}

	public function checkOldPassword($admin_id, $password_to_check) {
		
		$admin = Admin::find($admin_id);

		if(Auth::attempt(["id" => $admin->id, "password" => $password_to_check])) {
			return true;
		} else {
			return false;
		}
	}

	public function checkConfirmPassword($new_password, $new_password_confirm) {
		
		if( $new_password === $new_password_confirm ) {
			return true;
		} else {
			return false;
		}
	}
}