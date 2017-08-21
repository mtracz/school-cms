<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\FileService;

class FileController extends Controller {

	protected $file_service;

	public function __construct() {
		$this->file_service = new FileService();
	}

	public function getFileView() {
		return view("file_test");
	}

	public function addFile(Request $request) {
		// dd($request->file, $request["file"]);
		$this->file_service->validateFile($request["file"])->checkSlug()->saveFileOnServer();

		// dd($this->file_service->getErrors());

		if($this->file_service->getErrors()) {
			return json_encode($this->file_service->getErrors());
		} else {
			Session::flash("messages", ["Zapisano plik" => "success" ]);
			return response(["file_status" => "success"]);
		}
	}

	public function deleteFile($name) {

	}
}