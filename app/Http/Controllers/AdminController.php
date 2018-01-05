<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Services\ManageAdminService;

class AdminController extends Controller {
	
	protected $AdminService;

	public function __construct() {
		$this->AdminService = new ManageAdminService();
	}

	public function addAdmin(Request $request) {
		$this->AdminService->setAdminData($request->all())->saveAdmin();
			
		if($this->AdminService->getErrors()) {
			return json_encode($this->AdminService->getErrors());
		} else {
			Session::flash("messages", ["Dodano administratora" => "success" ]);
			return response(["add_status" => "success",
				"route" => route("admin.manage.get")]);
		}
	}

	public function editAdmin($id, Request $request) {
		$this->AdminService->setAdminData($request->all())->updateAdmin($id);
			
		if($this->AdminService->getErrors()) {
			return json_encode($this->AdminService->getErrors());
		} else {
			Session::flash("messages", ["Edytowano administratora" => "success" ]);
			return response(["edit_status" => "success",
				"route" => route("admin.manage.get")]);
		}
	}

	public function deleteAdmin($id) {
		$this->AdminService->deleteAdminFromDB($id);

		if(! $this->AdminService->isDeleted()) {
			return response(["error" => "Nie znaleziono administratora o podanym ID"]);
		}
		return response("success");		
	}
}