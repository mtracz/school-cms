<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Redirect;
use Auth;

use App\Services\Auth\LoginService;
use LogService;

class LoginController extends Controller {

	public function login(Request $request) {
		$login_service = new LoginService();

		$login_service->setData($request->all())->validate()->login();
		if($login_service->isLogged()) {
			LogService::LoginSuccess("");
			return response(["login_status" => "success",
				"login_route" => Route("index.get")
				]);
		} else {
			Session::flash("errors", $login_service->getErrors());
			LogService::LoginFail("");
			return json_encode($login_service->getErrors());
		}
	}

	public function logout() {
		Session::flash("messages", ["Zostałeś/łaś wylogowany" => "success" ]);
		LogService::Logout("");
		Auth::logout();
		return Redirect::route("index.get");
	}

}