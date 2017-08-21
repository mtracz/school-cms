<?php 

namespace App\Services;

use File;

use App\Helpers\SlugHelper;

class FileService {

	protected $allowed_extensions = ["pdf",
									"doc",
									"docx",
									];
								
	protected $isFileValid = false;
	protected $filePath = "files/";
	protected $file;
	protected $file_slug;
	protected $file_name;
	protected $is_slug_unique = false;
	protected $errors = [];
	protected $is_file_saved = false;
	

	public function validateFile($file) {		
		if($file->isValid()) {			
			if($this->validateFileExtension($file->extension()) && $this->validateFileSize(filesize($file))) {
				$this->isFileValid = true;
				$this->file = $file;
				return $this;
			}
		}
		return $this;
	}

	protected function validateFileSize($file_size) {
		$allowed_filesize = 20971520; // Bytes = 20MB	
		if($file_size <= $allowed_filesize) {
			return true;
		}
		return false;
	}

	protected function validateFileExtension($file_extension) {
		if(in_array($file_extension, $this->allowed_extensions)) {
			return true;
		}
		return false;
	}

	public function checkSlug() {
		$filename = pathinfo($this->file->getClientOriginalName(), PATHINFO_FILENAME);
		$this->file_slug = SlugHelper::createSlug($filename);

		$this->file_name = $this->file_slug . "." . $this->file->extension();

		$images = [];
		$files = File::files($this->filePath);

		foreach ($files as $path) {
			$basename = pathinfo($path, PATHINFO_BASENAME);
			array_push($images, $basename);
		}

		$test = in_array($this->file_name, $images);
		// $klucz = array_search($this->file_name,  $images);

		// dump($test, $klucz);
		if(!$test) {
			$this->is_slug_unique = true;
		}
		return $this;
	}

	public function saveFileOnServer() {
		// $this->checkSlug();

		if($this->is_slug_unique) {
			$this->file->move(public_path($this->filePath), $this->file_name);
		} else {
			array_push($this->errors, "Istnieje już plik o takiej samej nazwie");
		}
	}

	public function getErrors() {
		return $this->errors;
	}

}