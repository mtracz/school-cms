<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\ManageNewsService;

class NewsController extends Controller {
	
	protected $NewsService;

	public function __construct() {
		$this->NewsService = new ManageNewsService();
	}

	public function addNews(Request $request) {
		$this->NewsService->setNewsData($request)->saveNews();
			
		if($this->NewsService->getErrors()) {
			return json_encode($this->NewsService->getErrors());
		} else {
			return response(["news_add_status" => "success"]);
		}
	}
}