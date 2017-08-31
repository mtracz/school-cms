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
		// dd($request->all());
		$this->NewsService->setNewsData($request->all())->saveNews();
			
		if($this->NewsService->getErrors()) {
			return json_encode($this->NewsService->getErrors());
		} else {
			Session::flash("messages", ["Dodano newsa" => "success" ]);
			return response(["add_status" => "success",
				"route" => route("news.manage.get")]);
		}
	}

	public function editNews($id, Request $request) {
		// dd($request->all());
		$this->NewsService->setNewsData($request->all())->updateNews($id);

		if($this->NewsService->getErrors()) {
			return json_encode($this->NewsService->getErrors());
		} else {
			Session::flash("messages", ["Edytowano newsa" => "success" ]);
			return response(["edit_status" => "success",
				"route" => route("news.manage.get")]);
		}
	}

	public function deleteNews($id) {
		$this->NewsService->deleteNewsFromDB($id);

		if(! $this->NewsService->isDeleted()) {
			Session::flash("messages", ["Nie znaleziono newsa o podanym ID" => "error" ]);
			return redirect()->route("index.get");
		}

		Session::flash("messages", ["Usunięto newsa" => "success" ]);
		return redirect()->route("news.manage.get");
	}
}