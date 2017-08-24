<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Models\Admin;
use App\Models\News;
use App\Models\NewsPinned;
use App\Models\Theme;
use App\Models\Settings;
use App\Models\StaticPage;

use App\Http\Controllers\SettingsController;
use App\Services\PaginationService;
use App\Services\NewsManageService;

use Carbon\Carbon;

class ViewController extends Controller {

	public function index(Request $request) {

		$this->request = $request;

		$news_pinned = $this->getNewsPinned();

		$page_number = 1;

		$news = $this->getNewsSpecific();
		$news_per_page_value = Settings::where("name","news_per_page")->first()->value;
		
		$paginationService = new PaginationService($request, $news, $news_per_page_value);

		$pagination_array = $paginationService->getPaginationArray();
		$next_page = $paginationService->getNextPage();
		$prev_page = $paginationService->getPrevPage();
		$max_page = $paginationService->getMaxPage();
		$page_number = $paginationService->getPageNumber();

		$news_set = $news->forPage($page_number, $news_per_page_value);

		return view("mainLayout")
		->with("news", $news_set)
		->with("news_pinned", $news_pinned)
		->with("news_per_page", $news_per_page_value)
		->with("pagination_array", $pagination_array)
		->with("first_page", 1)
		->with("last_page", $max_page)
		->with("prev_page", $prev_page)
		->with("next_page", $next_page)
		->with("current_page", $page_number);
	}

	public function getNewsSpecific() {

		$news;

		$news_pinned = $this->getNewsPinned();

		if($news_pinned) {

			$news = News::orderBy("published_at", "desc")
			->where("published_at", "<=", Carbon::now()->toDateTimeString())
			->whereNull("expire_at")
			->where("is_public","1")
			->where("id", "<>", $news_pinned->news_id)
			->orWhere(function ($query) {
				$query->where("published_at", "<=", Carbon::now()->toDateTimeString())
				->where("expire_at", ">", Carbon::now()->toDateTimeString())
				->where("is_public","1");
			})
			->get();

		} else {

			$news = News::orderBy("published_at", "desc")
			->where("published_at", "<=", Carbon::now()->toDateTimeString())
			->whereNull("expire_at")
			->where("is_public","1")
			->orWhere(function ($query) {
				$query->where("published_at", "<=", Carbon::now()->toDateTimeString())
				->whereNull("expire_at", ">", Carbon::now()->toDateTimeString())
				->where("is_public","1");
			})
			->get();
		}

		return $news;
		
	}

	public function getNewsPinned() {
		return NewsPinned::first();
	}

	public function test() {

		return view("test");
	}

	public function getLoginView() {
		$super_admin = Admin::where("is_super_admin", 1)->first();

		if($super_admin) {
			// super admin created in past
			return view("adminLogin");
		} else {
			// super admin not created - first login
			return view("adminCreate");
		}    	
	}

	public function getMaintenancePage() {

		return view("maintenance");
	}

	public function getNewsFormAdd() {
		$newsPinnedObject = NewsPinned::first();
		return view("addEditNews")->with("newsPinned", $newsPinnedObject);
	}

	public function getNewsFormEdit($id) {
		$editing_news = News::find($id);
		$newsPinnedObject = NewsPinned::first();
		if(! $editing_news) {
			Session::flash("messages", ["Nie znaleziono newsa o podanym ID" => "error" ]);
			return redirect()->route("index.get");
		}

		return view("addEditNews")->with("editing_news", $editing_news)
		->with("newsPinned", $newsPinnedObject);
	}

	public function getSettings() {
		$settingsController = new SettingsController();

		$settings = $settingsController->getSettings();
		$themes = Theme::all();

		return view("settings")->with("settings", $settings)->with("themes", $themes);
	}

	public function getNewsManagePage(Request $request) {

		$params = $request->all();

		$news = $this->getNewsAll();

		if(count($params) > 1) {

			$newsManageService = new NewsManageService();
			$news = $newsManageService->pluckNews($params);
		}

		$news_pinned_id = $this->getNewsPinned();

		$news_attributes_count = count($news[0]->getAttributes());

		$page_number = 1;
		$news_per_page = 15;

		$paginationService = new PaginationService($request, $news, $news_per_page);

		$pagination_array = $paginationService->getPaginationArray();
		$next_page = $paginationService->getNextPage();
		$prev_page = $paginationService->getPrevPage();
		$max_page = $paginationService->getMaxPage();
		$page_number = $paginationService->getPageNumber();

		$news_set = $news->forPage($page_number, $news_per_page);

		/*
		Added + 1 to columns_count for actions header in newsManage
		*/
		return view("newsManage")
		->with("pagination_array", $pagination_array)
		->with("first_page", 1)
		->with("last_page", $max_page)
		->with("prev_page", $prev_page)
		->with("next_page", $next_page)
		->with("current_page", $page_number)
		->with("news_pinned", $news_pinned_id)
		->with("items", $news_set)
		->with("columns_count", $news_attributes_count);
	}

	public function getPagesManagePage(Request $request) {

		$params = $request->all();

		return view("pagesManage");
	}

	public function hasPage($params) {
		if(isset($params["page"])) {
			return true;
		} else {
			return false;
		}
	}

	public function getNewsAll() {
		
		$news = News::orderBy("published_at", "desc")->get();

		return $news;
	}

	public function getPageFormAdd() {
		return view("addEditPage");
	}

	public function getPageFormEdit($id) {
		$editing_page = StaticPage::find($id);
		if(! $editing_page) {
			Session::flash("messages", ["Nie znaleziono strony o podanym ID" => "error" ]);
			return redirect()->route("index.get");
		}
		return view("addEditPage")->with("editing_page", $editing_page);
	}

}
