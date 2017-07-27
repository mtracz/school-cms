<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

use App\Services\Auth\RegisterService;
use LogService;

class RegisterController extends Controller {
    
    public function register(Request $request) {
    	$register_service = new RegisterService();

    	$register_service->setRegisterData($request->all())->validate()->registerSuperAdmin();
	    if(! $register_service->registerStatus()) {
			Session::flash("errors", $register_service->getErrors());
			return json_encode($register_service->getErrors());
		}
			LogService::Add("Stworzenie konta super admina");
			Session::flash("messages", ["Tworzenie konta super administratora przebiegło pomyslnie. Zostaniesz przekierowany na stronę logowania.\n Jeżeli tak się nie stanie to odśwież tą stronę" => "success" ]);
			return response(["register_status" => "success",		
				]);

	    }
}