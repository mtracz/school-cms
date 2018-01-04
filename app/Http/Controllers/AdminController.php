<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\ManageAdminService;

class AdminController extends Controller {
	
	protected $AdminService;

	public function __construct() {
		$this->AdminService = new ManageAdminService();
	}

	public function addAdmin() {
		# code...
	}

	public function editAdmin() {
		# code...
	}

	public function deleteAdmin($id) {
		$this->AdminService->deleteAdminFromDB($id);

		if(! $this->AdminService->isDeleted()) {
			return response(["error" => "Nie znaleziono administratora o podanym ID"]);
		}
		return response("success");		
	}
}