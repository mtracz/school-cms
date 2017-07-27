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
}