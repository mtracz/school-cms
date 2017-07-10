<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\RegisterService;

class RegisterController extends Controller {
    
    public function registerAdmin(Request $request) {
    	$regisetr_service = new RegisterService();

    	$regisetr_service->setRegisterData($request->all())->validate()->register();
	    if(! $registerService->registerStatus()) {
				Session::flash("errors", $registerService->getErrors());
				return json_encode($registerService->getErrors());
			}
			return response(["register_status" => "success",
				"register_message" => "Tworzenie konta super administratora przebiegło pomyslnie. Zostaniesz przekierowany na stronę logowania.\n Jeżeli tak się nie stanie to odśwież tą stronę.",
				]);

	    }
}