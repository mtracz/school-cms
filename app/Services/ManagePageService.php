<?php 

namespace App\Services;

use Auth;
use File;

use App\Models\StaticPage;
use LogService;
use SlugHelper;
use App\Services\ImageService;

class ManagePageService {

	protected $pageData = [
		"content" => "",
		"title" => "",
		"is_public" => "",
	];

	protected $images_src = [];
	protected $page_dir = "images/pages/";

	protected $is_public = false; //unchecked
	protected $slug;
	protected $is_slug_unique = false;
	protected $created_by;
	protected $errors = [];
	protected $is_page_deleted = false;

	public function setPageData($request) {
		$this->pageData["content"] = $request["content"];
		$this->pageData["title"] = $request["title"];
		$this->pageData["is_public"] = $request["is_public"];

		$this->images_src = json_decode($request['json_images_src']);

		$this->created_by = Auth::user()->id;
		
		$this->checkCheckboxes();
		
		$this->slug = SlugHelper::createSlug($request["title"]);

		return $this;
	}

	protected function checkCheckboxes() {
		if($this->pageData["is_public"] === "true") {
			$this->is_public = true;
		}
	}

	public function savePage() {

		$this->isSlugCorrect($this->slug);

		if(!$this->is_slug_unique) {
			array_push($this->errors, "Isnieje już strona o takim tytule. Podaj inny tytuł");
			return false;
		}
		//change this
		if($this->images_src) {
			$this->preparePageDir();			
			$this->createPageDir($this->page_dir);
			$this->changeImagesSrcInContent();
			$imageService = new ImageService();
			$imageService->moveImagesFromTemp($this->images_src, $this->page_dir);
		}

		$pageObject = new StaticPage();
		$pageObject->title = $this->pageData["title"];
		$pageObject->content = $this->pageData["content"];
		$pageObject->slug = $this->slug;
		$pageObject->created_by = $this->created_by;	
		$pageObject->is_public = $this->is_public;
		$pageObject->save();

		LogService::add("page: " . $this->pageData["title"]);
	}

	public function updatePage($id) {

		$pageObject = StaticPage::find($id);
		if($pageObject) {

			$this->isSlugCorrectEditMode($this->slug, $id);

			if(!$this->is_slug_unique) {
				array_push($this->errors, "Isnieje już strona o takim tytule. Podaj inny tytuł");
				return false;
			}

			$this->preparePageDir();

			if($pageObject->slug != $this->slug) {
				$this->createPageDir($this->page_dir);
			}

			if($this->images_src) {
			//images src from content in add/edit page
				$this->createPageDir($this->page_dir);
				$this->changeImagesSrcInContent();

				$uploaded_images = [];
				$temp_images = [];
				foreach ($this->images_src as $image) {
					if(strpos($image, 'temp') !== false) {
						array_push($temp_images, $image);
					} else {
						array_push($uploaded_images, $image);
					}			
				}

				$imageService = new ImageService();
				if($temp_images) {
					$imageService->moveImagesFromTemp($temp_images, $this->page_dir);	
				}
				if($uploaded_images) {
					$imageService->moveUploadedImages($uploaded_images, $this->page_dir);
				}						
			} else {
				$this->deleteOldNewsDir($pageObject->slug, $this->slug, $this->page_dir);
			}

			if($pageObject->slug != $this->slug) {
				$this->deleteOldPageDir($pageObject->slug, $this->slug, $this->page_dir);				
			} else {
				//delete(from server) deleted images from news content
				$this->deleteDeletedImages($this->page_dir, $this->images_src);
			}

			$this->changeImagesPathInContent($pageObject->slug);

			$pageObject->title = $this->pageData["title"];
			$pageObject->content = $this->pageData["content"];
			$pageObject->slug = $this->slug;
			$pageObject->created_by = $this->created_by;
			$pageObject->is_public = $this->is_public;
			$pageObject->save();

			LogService::edit("page: " . $this->pageData["title"]);	
		} else {
			array_push($this->errors, "Nie znaleziono strony o podanym id");
		}
	}

	protected function isSlugCorrect($slug) {
		$page = StaticPage::where("slug", $slug)->first();	
		if(!$page) {
			$this->is_slug_unique = true;
		}
	}

	protected function isSlugCorrectEditMode($slug, $id) {
		$page = StaticPage::where("slug", $slug)->where("id", "!=", $id)->first();
		if(!$page) {
			$this->is_slug_unique = true;
		}
	}

	public function getErrors() {
		return $this->errors;
	}

	protected function preparePageDir() {
		$this->page_dir .= $this->slug;
	}

	protected function createPageDir($dir) {
		File::makeDirectory("./" . $dir, 0755, true, true);
	}

	protected function deleteOldPageDir($old_name, $new_name, $dir) {
		$old_dir = str_replace($new_name, $old_name, $dir);
		File::deleteDirectory($old_dir);
	}

	protected function deleteDeletedImages($dir, $images_src) {
		if($images_src) {
			$files = File::files($dir);
			$images = [];
			foreach ($files as $path) {
				$path_info = pathinfo($path);
				array_push($images, $path_info["basename"]);
			}

			$alive_images = [];
			foreach ($images_src as $image) {
				$path_info = pathinfo($image);
				$file = explode("?", $path_info["basename"]);
				$filename = $file[0];
				array_push($alive_images, $filename);
			}

			foreach ($images as $image) {
				if(!in_array($image, $alive_images)) {
					File::delete($dir . "/" . $image);
				}
			}
		}
	}

	protected function changeImagesSrcInContent() {
		$this->pageData["content"] = str_replace("images/temp/", $this->page_dir, $this->pageData["content"]);
	}

	protected function changeImagesPathInContent($old_slug) {
		$this->pageData["content"] = str_replace("/" . $old_slug . "/", "/" . $this->slug . "/", $this->pageData["content"]);
	}

	public function deletePageFromDB($page_id) {
		$deletedPage = StaticPage::find($page_id);

		if($deletedPage) {	
			LogService::delete("page: " . $deletedPage->title);
			$deletedPage->delete();
			$this->is_page_deleted = true;
		}
	}

	public function isDeleted() {
		return $this->is_page_deleted;
	}
}