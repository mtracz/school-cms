<?php 

namespace App\Services;

use Auth;
use File;

use App\Models\StaticPage;
use LogService;
use SlugHelper;
// use App\Services\ImageService;

class ManagePageService {

	protected $pageData = [
		"content" => "",
		"title" => "",
		"is_public" => "",
	];

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
			array_push($this->errors, "Isnieje już news o takim tytule. Podaj inny tytuł");
			return false;
		}
		//change this
		if($this->images_src) {
			$this->prepareNewsDir();			
			$this->createNewsDir($this->news_dir);
			$this->changeImagesSrcInContent();
			$imageService = new ImageService();
			$imageService->moveImagesFromTemp($this->images_src, $this->news_dir);
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

	protected function isSlugCorrect($slug) {
		$page = StaticPage::where("slug", $slug)->first();	
		if(!$page) {
			$this->is_slug_unique = true;
		}
	}

	public function getErrors() {
		return $this->errors;
	}



	public function deletePageFromDB($page_id) {
		$deletedPage = StaticPage::find($page_id);

		if($deletedPage) {			
			$deletedPage->delete();
			$this->is_page_deleted = true;
		}
	}

	public function isDeleted() {
		return $this->is_page_deleted;
	}
}