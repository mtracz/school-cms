<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use File;

use App\Models\Admin;
use App\Models\News;
use App\Models\NewsPinned;
use App\Models\Theme;
use App\Models\Settings;
use App\Models\StaticPage;
use App\Models\Element;
use App\Models\SiteSector;
use App\Models\Menu;
use App\Models\PanelType;
use App\Models\Panel;

use App\Http\Controllers\SettingsController;
use App\Services\PaginationService;
use App\Services\NewsManageService;
use App\Services\PagesManageService;
use App\Services\FilesManageService;
use App\Http\Controllers\FileController;

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

		$maintenance_text = Settings::where("name", "maintenance_mode_text")->first();
		$maintenance_title = Settings::where("name", "title")->first();
		$maintenance_settings = [ "text" => $maintenance_text["value"],
								"title" => $maintenance_title["value"]];

		return view("maintenance")->with("settings", $maintenance_settings);
	}

	public function getNewsFormAdd() {
		// debug after change to laravel 5.5.0
		// dd(File::files("images/news/"));

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
		$items_count_all = count($news);

		if(count($params) > 1) {

			$newsManageService = new NewsManageService();
			$news = $newsManageService->pluckNews($params);
		}

		$news_attributes_count = 10;

		if(count($news) > 0) {

			$news_pinned_id = $this->getNewsPinned();

			$page_number = 1;
			$news_per_page = 15;

			$paginationService = new PaginationService($request, $news, $news_per_page);

			$pagination_array = $paginationService->getPaginationArray();
			$next_page = $paginationService->getNextPage();
			$prev_page = $paginationService->getPrevPage();
			$max_page = $paginationService->getMaxPage();
			$page_number = $paginationService->getPageNumber();

			$news_set = $news->forPage($page_number, $news_per_page);

			$items_count = 0;

			for($i = 0; $i < $page_number; $i++) {
				$items_count += count($news->forPage($i+1, $news_per_page));
			}

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
			->with("items_count", $items_count)
			->with("items_count_all", $items_count_all)
			->with("columns_count", $news_attributes_count);

		} else {

			$news_set = $news;

			return view("newsManage")
			->with("items", $news_set)
			->with("columns_count", $news_attributes_count);
		}
	}

	public function getPagesManagePage(Request $request) {

		$params = $request->all();

		$pages = $this->getPagesAll();

		$items_count_all = count($pages);
		$pages_attributes_count = 5;

		if(count($params) > 1) {

			$pagesManageService = new PagesManageService();
			$pages = $pagesManageService->pluckPages($params);
		}

		$page_number = 1;
		$pages_per_page = 15;

		if($pages && count($pages) > 0) {
			$paginationService = new PaginationService($request, $pages, $pages_per_page);

			$pagination_array = $paginationService->getPaginationArray();
			$next_page = $paginationService->getNextPage();
			$prev_page = $paginationService->getPrevPage();
			$max_page = $paginationService->getMaxPage();
			$page_number = $paginationService->getPageNumber();

			$pages_set = $pages->forPage($page_number, $pages_per_page);

			$items_count = 0;
			for($i = 1; $i <= $page_number; $i++) {
				$items_count += count($pages->forPage($i, $pages_per_page));
			}

			return view("pagesManage")
			->with("pagination_array", $pagination_array)
			->with("first_page", 1)
			->with("last_page", $max_page)
			->with("prev_page", $prev_page)
			->with("next_page", $next_page)
			->with("current_page", $page_number)
			->with("items", $pages_set)
			->with("items_count", $items_count)
			->with("items_count_all", $items_count_all)
			->with("columns_count", $pages_attributes_count + 1)
			->with("params", $params);

		} else {

			$pages_set = $pages;

			return view("pagesManage")
			->with("items", $pages_set)
			->with("columns_count", $pages_attributes_count + 1)
			->with("params", $params);
		}
	}

	public function getFilesManagePage(Request $request) {

		$params = $request->all();

		$fileController = new FileController();

		$files = $fileController->getAllFilesFromServer();
		$files = json_decode($files);

		$files_array = [];
		foreach($files as $file) {
			array_push($files_array, $file);
		}

		$items_count_all = count($files_array);
		$files_attributes_count = 1;

		$temp = $params;

		if(isset($temp["page"])) {
			unset($temp["page"]);
		}

		if(count($temp) >= 1) {

			$filesManageService = new FilesManageService();
			$files_array = $filesManageService->pluckFiles($params);
		}

		$files = collect($files_array);

		$page_number = 1;
		$files_per_page = 15;

		if(count($files) > 0) {
			$paginationService = new PaginationService($request, $files, $files_per_page);

			$pagination_array = $paginationService->getPaginationArray();
			$next_page = $paginationService->getNextPage();
			$prev_page = $paginationService->getPrevPage();
			$max_page = $paginationService->getMaxPage();
			$page_number = $paginationService->getPageNumber();

			$files_set = $files->forPage($page_number, $files_per_page);

			$items_count = 0;
			for($i = 1; $i <= $page_number; $i++) {
				$items_count += count($files->forPage($i, $files_per_page));
			}

			$temp = [];

			foreach($files_set as $file) {
				array_push($temp, ["name" => $file]);
			}

			$files_set = $temp;

			return view("filesManage")
			->with("pagination_array", $pagination_array)
			->with("first_page", 1)
			->with("last_page", $max_page)
			->with("prev_page", $prev_page)
			->with("next_page", $next_page)
			->with("current_page", $page_number)
			->with("items", $files_set)
			->with("items_count", $items_count)
			->with("items_count_all", $items_count_all)
			->with("columns_count", $files_attributes_count + 1)
			->with("params", $params);

		} else {

			$files_set = $files;

			return view("filesManage")
			->with("items", $files_set)
			->with("columns_count", $files_attributes_count + 1)
			->with("params", $params);
		}
	}

	public function getElementsManagePage(Request $request) {

		$site_sectors = $this->getSiteSectorsAll();
		$elements = $this->getElementsAll();
		$panel_types = $this->getPanelTypesAll();

		return view("elements.elementsManage")
		->with("site_sectors", $site_sectors)
		->with("panel_types", $panel_types)
		->with("elements", $elements);
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

	public function getPagesAll() {

		$pages = StaticPage::orderBy("created_at", "desc")->get();

		return $pages;
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

	public function getPageView($slug) {
		$page = StaticPage::where("slug", $slug)->where("is_public", true)->first();
		
		if($page) {
			return view("templates/staticPage")->with("page", $page);
		} else {
			Session::flash("messages", ["Nie znaleziono takiej strony" => "error" ]);
			return redirect()->route("index.get");
		}
	}

	public function getNewsView($slug) {
		$news = News::where("slug", $slug)->where("is_public", true)->first();
		
		if($news) {
			$show_news = true;
			return view("templates/staticPage")->with("page", $news)
												->with("show_news", $show_news);
		} else {
			Session::flash("messages", ["Nie znaleziono takiej strony" => "error" ]);
			return redirect()->route("index.get");
		}
	}

	public function getMenuAddView(Request $request) {

		$parameters = $request->all();

		$sector_id = $parameters["sector_id"] ?? "brak sektora";
		$sector_name = $parameters["sector_name"] ?? "brak sektora";

		return view("elements.addMenu")
		->with("sector_id", $sector_id)
		->with("sector_name", $sector_name);
	}

	public function getMenuEditView(Request $request, $id) {

		$parameters = $request->all();

		$sector_id = $parameters["sector_id"] ?? "brak sektora";
		$sector_name = $parameters["sector_name"] ?? "brak sektora";

		$editing_mode = true;

		$menuObject = Menu::find($id);
		
		return view("elements.addMenu")
		->with("sector_id", $sector_id)
		->with("sector_name", $sector_name)
		->with("menuObject", $menuObject)
		->with("editing_mode", $editing_mode);
	}

	public function getSiteSectorsAll() {

		$site_sectors = SiteSector::all();

		return $site_sectors;
	}

	public function getElementsAll() {

		$elements = Element::orderBy("order", "asc")->get();

		return $elements;
	}

	public function getPanelTypesAll() {
		$panel_types = PanelType::all();

		return $panel_types;
	}

	public function getSiteMap() {

		$menus = Menu::all();

		return view("templates.sitemap")
			->with("menus", $menus);
	}

	public function redirectArticle($article_id) {
		$articleObject = StaticPage::find($article_id);

		return redirect()->route("pages.show.get", $articleObject->slug ?? " ");
	}

	//PANELS
	public function getPanelAddView(Request $request) {
		$parameters = $request->all();

		$sector_id = $parameters["sector_id"] ?? "brak sektora";
		$sector_name = $parameters["sector_name"] ?? "brak sektora";
		$panel_type_id = $parameters["panel_type_id"] ?? "bral id typu panelu";
		$item_name = $parameters["item_name"] ?? "brak item_name";

		return view("elements.addEditPanel")
		->with("panel_type_id", $panel_type_id)
		->with("item_name", $item_name)
		->with("sector_id", $sector_id)
		->with("sector_name", $sector_name);
	}

	public function getPanelEditView(Request $request, $id) {
		$parameters = $request->all();

		$sector_id = $parameters["sector_id"] ?? "brak id sektora";
		$sector_name = $parameters["sector_name"] ?? "brak nazwy sektora";

		$panelObject = Panel::find($id);
		
		return view("elements.addEditPanel")
		->with("sector_id", $sector_id)
		->with("sector_name", $sector_name)
		->with("panelObject", $panelObject);
	}

}

