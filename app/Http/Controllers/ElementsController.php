<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Services\ElementsUpdateService;
use App\Services\ElementsManageService;

class ElementsController extends Controller
{
    public function updateElements(Request $request) {

    	$elements = $request->all();

    	$elementsUpdateService = new ElementsUpdateService();
    	$elementsUpdateService->saveChanges($elements["data"]);

    	dump($elements);
    }

    public function addMenu(Request $request) {
    	$elementsManageService = new ElementsManageService();
    	$elementsManageService->prepareMenuData($request->all())->buildMenu();

    	if($elementsManageService->isMenuSaved()) {
    		Session::flash("messages", ["<h2>Dodano nowe menu</h2>" => "success" ]);
    		return response("success");
    	}
    }


}
