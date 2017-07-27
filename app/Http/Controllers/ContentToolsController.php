<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\ImageService;

class ContentToolsController extends Controller {


	public function uploadImage(Request $image_request) {
		$imageService = new ImageService();
		$imageService->setImageData($image_request);

		return $imageService->getResponse();
	}

	public function rotateImage(Request $image_request) {		
		$imageService = new ImageService();
		$imageService->rotate($image_request->all());

		return $imageService->getResponse();
	}

	public function saveImage(Request $image_request) {	
		$imageService = new ImageService();
		$imageService->addImage($image_request->all());

		return $imageService->getResponse();
	}
}