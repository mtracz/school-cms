<?php 

namespace App\Services;

use File;

class ImageService {

	protected $temp_dir = "images/temp/";

	protected $file;
	protected $file_name;
	protected $extension;
	protected $file_complete_path;

	protected $image_url;
	protected $source_image;

	protected $size = []; //width, height
	protected $width;
	protected $height;

	protected $response = [];

	protected $jpeg_quality = 100;
	protected $png_compression = 0;


	public function setImageData($request) {
		
		$this->file = $request->file("image");

		list($this->width, $this->height) = getimagesize($this->file);
		$this->size = [$this->width, $this->height];

		$this->file_name = $this->file->getClientOriginalName();

		$this->storeImageInTempDir();
		$this->setResponse($this->size, $this->file_complete_path);		
		var_dump(public_path());
	}

	protected function storeImageInTempDir() {
		$this->file_complete_path = $this->file->storeAs($this->temp_dir, $this->file_name, "public");
	}

	protected function setResponse($image_size, $image_url) {
		$this->response = [
			"size" => $image_size,
			"url" => url('/') . "/" . $image_url,
		];
	}

	public function getResponse() {
		return $this->response;
	}

	protected function setImageSize($image) {
		$this->width = imagesx($image);
		$this->height = imagesy($image);
		$this->size = [$this->width, $this->height];
	}

	protected function getDirectImagePath($image_url) {
		$string = str_replace(url('/') . "/", "", $image_url);
		$string = explode("?", $string);
		return $string[0];
	}

	public function rotate($request) {		
		$this->image_url = $this->getDirectImagePath($request["url"]);
		// dd($this->image_url);
		$direction = $request["direction"];
		
		if($direction === "CW") {
			// Clockwise (right)
			$rotation = 90;
		}
		if($direction === "CCW") {
			// Counterclockwise (left)
			$rotation = -90;
		}

		$this->readImageDataFromServer($this->image_url);

		$image_rotated = imagerotate($this->source_image, $rotation * -1, 0);
	
		$this->setImageSize($image_rotated);
		$this->saveImageInTemp($image_rotated);
		$this->setResponse($this->size, $this->image_url);
	}

	protected function readImageDataFromServer($image_url) {
		$this->file_name = File::basename($image_url);
		$this->extension = File::extension($image_url);		
		$image_on_server = File::get($image_url);
		$this->source_image = imagecreatefromstring($image_on_server);
	}

	protected function saveImageInTemp($image) {
		$this->checkExtension($this->extension, $image, $this->temp_dir);		
	}

	public function moveImagesFromTemp($images_array, $destination_dir) {

		foreach ($images_array as $image) {
			$image_temp_url = $this->getDirectImagePath($image);

			$name = explode($this->temp_dir, $image_temp_url);
			$name = $name[1];

			File::copy($image_temp_url, $destination_dir . $name);
		}
		File::cleanDirectory($this->temp_dir);
	}

	public function moveUploadedImages($images_array, $destination_dir) {

		foreach ($images_array as $image) {

			$image_direct_path = $this->getDirectImagePath($image);
			
			$source_path = pathinfo($image_direct_path);
			$name = $source_path["basename"];
			
			File::move($image_direct_path, $destination_dir . "/" . $name);	
		}
	}
		

	public function addImage($request) {
		$this->image_url = $this->getDirectImagePath($request["url"]);
		$this->readImageDataFromServer($this->image_url);
		$this->setImageSize($this->source_image);

		if($request["crop"] !== "0,0,1,1") {

			$this->cropImage($request["crop"]);
		}

		$this->saveImageInTemp($this->source_image);	
		$this->setResponse($this->size, $this->image_url);	
	}

	protected function cropImage($request_crop) {

		$crop = explode(",", $request_crop);

		$crop_y = round($crop[0], 2) * $this->height;
		$crop_x = round($crop[1], 2) * $this->width;
		$crop_height = round($crop[2], 2) * $this->height;
		$crop_width = round($crop[3], 2) * $this->width;

		$this->width = $crop_width - $crop_x;
		$this->height = $crop_height - $crop_y;
		
		$raw_image = imagecreatetruecolor($this->width, $this->height);

		$image_croped = imagecrop($this->source_image, ['x' => $crop_x, 'y' => $crop_y, 'width' => $crop_width, 'height' => $crop_height]);

		imagecopyresized($raw_image, $image_croped, 0, 0, 0, 0, $crop_width, $crop_height, $crop_width, $crop_height);
		$this->setImageSize($raw_image);
		$this->source_image = $raw_image;
	}

	protected function checkExtension($extension, $image, $path) {
		switch($extension) {
			case 'jpg' :
			case 'jpeg' :
				$this->saveJPEG($image, $path);
				break;
			case 'png' :
				$this->savePNG($image, $path);		
				break;			
			default :
				return false; //failure on invalid extension
			}	
	}

	protected function saveJPEG($image, $path) {
		imagejpeg($image, $path . $this->file_name, $this->jpeg_quality);
	}

	protected function savePNG($image, $path) {
		imagepng($image, $path . $this->file_name, $this->png_compression);
	}
}
