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
		if ($request->hasFile("file")) {
			$this->file_service->validateFile($request["file"])->saveFileOnServer();
			if($this->file_service->isFileSaved()) {
				return response(["file_status" => "success"]);
			} else {
				return json_encode($this->file_service->getErrors());
			}
		} else {
			return response(["message" => "Nie wybrano pliku."]);
		}

	}

	public function deleteFile($name) {

	}

	public function getAllFilesFromServer() {
		return json_encode($this->file_service->getFiles());
	}
}