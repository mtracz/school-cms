<?php 

namespace App\Services;

use File;

use App\Helpers\SlugHelper;

class FileService {

	protected $allowed_extensions = ["pdf",
									"doc",
									"docx",
									];
								
	protected $is_file_valid = false;
	protected $filePathOnServer = "files/";
	protected $file;
	protected $file_slug;
	protected $file_name;
	protected $is_slug_unique;
	protected $errors = [];
	protected $is_file_saved = false;
	

	public function validateFile($file) {
		if($file->isValid()) {			
			if($this->validateFileExtension($file->extension()) && $this->validateFileSize(filesize($file))) {
				$this->is_file_valid = true;
				$this->file = $file;
			}
		}
		return $this;
	}

	protected function validateFileSize($file_size) {
		$allowed_filesize = 20971520; // Bytes = 20MB	
		if($file_size <= $allowed_filesize) {
			return true;
		}
		array_push($this->errors, "Za duży plik, max 20 Mb.");
		return false;
	}

	protected function validateFileExtension($file_extension) {
		if(in_array($file_extension, $this->allowed_extensions)) {
			return true;
		}
		array_push($this->errors, "Zły plik. Dozwolone: " . join(", ", $this->allowed_extensions));
		return false;
	}

	public function saveFileOnServer() {
		if($this->is_file_valid) {
			$this->checkSlug();
			if($this->is_slug_unique) {
				$this->file->move(public_path($this->filePathOnServer), $this->file_name);
				$this->is_file_saved = true;
			} else {
				array_push($this->errors, "Istnieje już plik o takiej samej nazwie");
			}
		}
		
	}

	protected function checkSlug() {
		$filename = pathinfo($this->file->getClientOriginalName(), PATHINFO_FILENAME);
		$this->file_slug = SlugHelper::createSlug($filename);

		$this->file_name = $this->file_slug . "." . $this->file->extension();

		$files_array = $this->listFilesInDirectory($this->filePathOnServer);

		$is_file_in_array = in_array($this->file_name, $files_array);

		if(!$is_file_in_array) {
			$this->is_slug_unique = true;
		} else {
			$this->is_slug_unique = false;
		}
	}

	protected function listFilesInDirectory($dir) : array {
		$files = File::files($dir);
		$files_on_server = [];

		foreach ($files as $path) {
			$basename = pathinfo($path, PATHINFO_BASENAME);
			array_push($files_on_server, $basename);
		}
		return $files_on_server;
	}

	public function getErrors() {
		return $this->errors;
	}

	public function isFileSaved() {
		return $this->is_file_saved;
	}

	public function getFiles() : array {
		$files = $this->listFilesInDirectory($this->filePathOnServer);
		$files_list = [];		
		foreach ($files as $value) {
			$path = route("index.get") . "/files/" . $value;
			$files_list += [$path => $value];
		}
		return $files_list;
	}
}