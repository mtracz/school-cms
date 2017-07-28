<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

use App\Services\ManageNewsService;

class NewsController extends Controller {
	
	protected $NewsService;

	public function __construct() {
		$this->NewsService = new ManageNewsService();
	}

	public function addNews(Request $request) {
		$this->NewsService->setNewsData($request->all())->saveNews();
			
		if($this->NewsService->getErrors()) {
			return json_encode($this->NewsService->getErrors());
		} else {
			Session::flash("messages", ["Dodano newsa" => "success" ]);
			return response(["news_add_status" => "success",
				"route" => route("index.get")]);
		}
	}

	public function editNews($id, Request $request) {
		// dd($request->all());
		$this->NewsService->setNewsData($request->all())->updateNews($id);

		if($this->NewsService->getErrors()) {
			return json_encode($this->NewsService->getErrors());
		} else {
			Session::flash("messages", ["Edytowano newsa" => "success" ]);
			// return response(["news_edit_status" => "success",
				// "route" => route("index.get")]);
		}
	}
}