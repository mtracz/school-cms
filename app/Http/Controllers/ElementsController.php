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
    }

    // MENU //

    public function addMenu(Request $request) {
    	$elementsManageService = new ElementsManageService();
    	$elementsManageService->prepareMenuData($request->all())->buildMenu();

    	if($elementsManageService->isMenuSaved()) {
    		Session::flash("messages", ["<h2>Dodano nowe menu</h2>" => "success" ]);
    		return response("success");
    	}
    }

    public function editMenu(Request $request, $id) {
        // dd($request->all());
    	$elementsManageService = new ElementsManageService();
        $elementsManageService->prepareMenuData($request->all())->buildMenu($editing_mode = true, $id);

        if($elementsManageService->isMenuSaved()) {
            Session::flash("messages", ["<h2>Edytowano menu</h2>" => "success" ]);
            return response("success");
        }
    }

    public function deleteMenu($id) {
    	$elementsManageService = new ElementsManageService();
    	$elementsManageService->deleteMenuFromDatabase($id);

    	if($elementsManageService->isMenuDeleted()) {
    		return response("success");
    	} else {
    		return response("error: delete menu");
    	}
    }
    //--
    // PANELS //
    public function addPanel(Request $request) {
        dd("add panel", $request->all());
        // name, header, content, panel_type_id
        // site_sector_id, panel_id (po dodaniu)
    }

    public function editPanel(Request $request, $id) {
        dd("edit panel: ", $request->all(), $id);
        // dd($reguest->all(), $id);
    }

    public function deletePanel($id) {
        // dd("delete panel id: " . $id);
        dd("delete panel: ", $id);
    }

}
