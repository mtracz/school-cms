<?php 

namespace App\Services;
use Carbon\Carbon;
use Auth;

use App\Models\News;
use App\Models\NewsPinned;
use LogService;
use SlugHelper;
use App\Services\ImageService;

class ManageNewsService {

	protected $newsData = [
		"content" => "",
		"title" => "",
		"is_public" => "",
		"is_pinned" => "",
		"publish_at_date" => "",
		"publish_at_time" => "",
		"expire_at_date" => "",
		"expire_at_time" => "",
		"publish_at_now" => "",
		"expire_at_never" => "",
	];

	protected $images_src = [];
	protected $news_dir = "images/news/";
	protected $year;
	protected $month;

	protected $publish_date;
	protected $expire_date;
	protected $is_public = false; //unchecked
	protected $is_pinned = false; //unchecked
	protected $is_publish_now = false; //unchecked
	protected $is_expire_never = false; //unchecked
	protected $slug;
	protected $is_slug_unique = false;
	protected $created_by;
	protected $created_news_id;
	protected $errors = [];
	protected $is_date_correct = false;


	public function setNewsData($request) {
		$this->newsData["content"] = $request["content"];
		$this->newsData["title"] = $request["title"];
		$this->newsData["is_public"] = $request["is_public"];
		$this->newsData["is_pinned"] = $request["is_pinned"];
		$this->newsData["publish_at_date"] = $request["publish_at_date"];
		$this->newsData["publish_at_time"] = $request["publish_at_time"];
		$this->newsData["expire_at_date"] = $request["expire_at_date"];
		$this->newsData["expire_at_time"] = $request["expire_at_time"];
		$this->newsData["publish_at_now"] = $request["publish_at_now"];
		$this->newsData["expire_at_never"] = $request["expire_at_never"];

		$this->images_src = json_decode($request['json_images_src']);
		// dd($this->images_src);

		$this->created_by = Auth::user()->id;
		
		$this->checkCheckboxes();
		$this->parseDates();
		$this->checkDates();
		$this->slug = SlugHelper::createSlug($request["title"]);
		$this->isSlugCorrect($this->slug);

		return $this;
	}

	protected function parseDates() {
		if($this->is_publish_now) {
			$this->publish_date = Carbon::now();
		} else {
			$this->publish_date = $this->newsData["publish_at_date"] ." ". $this->newsData["publish_at_time"];
		}
		if($this->is_expire_never) {
				$this->expire_date = null;
		} else {
			$this->expire_date = $this->newsData["expire_at_date"] ." ". $this->newsData["expire_at_time"];
		}	
	}

	protected function checkDates() {
		//unchecked publish now
		if(!$this->is_publish_now) {
			if($this->publish_date < Carbon::now()) {
				array_push($this->errors, "Data publikacji nie może być mniejsza od daty bieżącej");
				return false;
			}
		}
		//unchecked expire publication
		if(!$this->is_expire_never) {
			if($this->expire_date < Carbon::now()) {
				array_push($this->errors, "Data zakończenia publikacji nie może być mniejsza od daty bieżącej");
				return false;
			}
		}
		//unchecked publish now & expire publication
		if(!$this->is_publish_now && !$this->is_expire_never) {
			if($this->publish_date > $this->expire_date) {
				array_push($this->errors, "Data publikacji nie może być większa od daty zakończenia publikacji");
				return false;
			}
		}

		$this->is_date_correct = true;
	}

	protected function checkCheckboxes() {
		if($this->newsData["is_public"] === "true") {
			$this->is_public = true;
		}

		if($this->newsData["is_pinned"] === "true") {
			$this->is_pinned = true;
		}

		if($this->newsData["publish_at_now"] === "true") {
			$this->is_publish_now = true;
		}

		if($this->newsData["expire_at_never"] === "true") {
			$this->is_expire_never = true;
		}
	}

	public function saveNews() {
		if(!$this->is_slug_unique) {
			array_push($this->errors, "Isnieje już news o takim tytule. Podaj inny tytuł");
			return false;
		}
		if(!$this->is_date_correct) {
			return false;
		}

		if($this->images_src) {
			$this->prepareNewsDir();
			$this->changeImagesSrcInContent();
			$imageService = new ImageService();
			$imageService->moveImagesFromTemp($this->images_src, $this->news_dir);
		}

		$newsObject = new News();
		$newsObject->title = $this->newsData["title"];
		$newsObject->content = $this->newsData["content"];
		$newsObject->slug = $this->slug;
		$newsObject->created_by = $this->created_by;
		$newsObject->published_at = $this->publish_date;
		$newsObject->expire_at = $this->expire_date;	
		$newsObject->is_public = $this->is_public;
		$newsObject->save();

		LogService::add("news: " . $this->newsData["title"]);

		$this->created_news_id = $newsObject->id;
		if($this->is_pinned) {
			$this->savePinnedNews();
		}
	}

	protected function savePinnedNews() {
		$pinnedNewsObject = NewsPinned::first();
		if(!$pinnedNewsObject) {
			$pinnedNewsObject = new NewsPinned();
		}
		$pinnedNewsObject->news_id = $this->created_news_id;
		$pinnedNewsObject->save();
	}
	
	protected function isSlugCorrect($slug) {
		$news = News::where("slug", $slug)->first();	
		if(!$news) {
			$this->is_slug_unique = true;
		}
	}

	public function getErrors() {
		return $this->errors;
	}

	protected function prepareNewsDir() {
		$string = explode("-", $this->publish_date);
		$this->year = $string[0];
		$this->month = $string[1];
		$this->news_dir .= $this->year . "/" . $this->month . "/" . $this->slug;
	}

	protected function changeImagesSrcInContent() {
		$this->newsData["content"] = str_replace("images/temp/", $this->news_dir, $this->newsData["content"]);
	}

}