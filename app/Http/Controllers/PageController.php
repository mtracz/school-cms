<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use File;

use App\Services\ManagePageService;

class PageController extends Controller {

	protected $PageService;

	public function __construct() {
		$this->PageService = new ManagePageService();
	}

	public function addPage(Request $request) {
		$this->PageService->setPageData($request->all())->savePage();
			
		if($this->PageService->getErrors()) {
			return json_encode($this->PageService->getErrors());
		} else {
			Session::flash("messages", ["Dodano stronę" => "success" ]);
			return response(["add_status" => "success",
				"route" => route("page.manage.get")]);
		}
	}

	public function editPage($id, Request $request) {
		$this->PageService->setPageData($request->all())->updatePage($id);

		if($this->PageService->getErrors()) {
			return json_encode($this->PageService->getErrors());
		} else {
			Session::flash("messages", ["Edytowano stronę" => "success" ]);
			return response(["edit_status" => "success",
				"route" => route("page.manage.get")]);
		}
	}

	public function deletePage($id) {
		$this->PageService->deletePageFromDB($id);

		if(! $this->PageService->isDeleted()) {
			return response(["error" => "Nie znaleziono newsa o podanym ID"]);
		}
		return response("success");
	}

	public function getAllPages() {
		return json_encode($this->PageService->getPages());
	}
}