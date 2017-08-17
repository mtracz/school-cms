<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Admin;
use App\Models\News;
use App\Models\NewsPinned;
use App\Models\Theme;
use App\Models\Settings;

use App\Http\Controllers\SettingsController;
use App\Services\PaginationService;

use Carbon\Carbon;

class ViewController extends Controller {
	public function index(Request $request) {

		$news_pinned = NewsPinned::first();

		$news;

		$news_per_page_value = Settings::where("name","news_per_page")->first()->value;

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

		$parameters = $request->all();
		$page_number = 1;

		if(isset($parameters["page"])) {
			$page_number = (int) $parameters["page"];
		}

		$on_each_side = 2;

		$paginatorService = new PaginatorService();

		$news_count = $news->count();
		$max_page = (int) ceil($news_count/$news_per_page_value);

		if($page_number > $max_page) {
			$page_number = $max_page;
		}

		$news = $news->forPage($page_number, $news_per_page_value);

		$paginator_array = [];
		for($i = $page_number - $on_each_side; $i < $page_number + $on_each_side + 1; $i++) {

			if($i >= 1 && $i <= $max_page) {
				array_push($paginator_array, $i);
			}
		}
		
		$prev_page = $page_number - 1;
		$next_page = $page_number + 1;
	
		return view("mainLayout")
			->with("news", $news)
			->with("news_pinned", $news_pinned)
			->with("news_per_page", $news_per_page_value)
			->with("paginator_array", $paginator_array)
			->with("first_page", 1)
			->with("last_page", $max_page)
			->with("prev_page", $prev_page)
			->with("next_page", $next_page)
			->with("current_page", $page_number);
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
		return view("addNews")->with("newsPinned", $newsPinnedObject);
	}

	public function getNewsFormEdit($id) {
		$editing_news = News::find($id);
		$newsPinnedObject = NewsPinned::first();
		return view("addNews")->with("editing_news", $editing_news)
		->with("newsPinned", $newsPinnedObject);
	}

	public function getSettings() {
		
		$settingsController = new SettingsController();

		$settings = $settingsController->getSettings();
		$themes = Theme::all();

		return view("settings")->with("settings", $settings)->with("themes", $themes);
	}

}
