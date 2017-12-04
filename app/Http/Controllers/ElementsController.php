<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Services\ElementsUpdateService;
use App\Services\ElementsManageService;
use App\Services\PanelsManageService;

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
        $panelsManageService = new PanelsManageService();
        $panelsManageService->preparePanelData($request->all())->addPanelToDatabase()->addElementInDatabase();

        if($panelsManageService->getErrors()) {
            return json_encode($panelsManageService->getErrors());
        } else if($panelsManageService->isPanelSaved()) {
            Session::flash("messages", ["<h2>Dodano nowy panel</h2>" => "success" ]);
            return response(["add_status" => "success",
                "route" => route("element.manage.get")]);
        }
    }

    public function editPanel(Request $request, $id) {
        $panelsManageService = new PanelsManageService();
        $panelsManageService->preparePanelData($request->all(), $id)->updatePanelInDatabase();

        if($panelsManageService->getErrors()) {
            return json_encode($panelsManageService->getErrors());
        } else if($panelsManageService->isPanelSaved()) {
            Session::flash("messages", ["<h2>Edytowano panel</h2>" => "success" ]);
            return response(["edit_status" => "success",
                "route" => route("element.manage.get")]);
        }
    }

    public function deletePanel($id) {
        $panelsManageService = new PanelsManageService();
        $panelsManageService->deletePanelFromDatabase($id);

        if($panelsManageService->isPanelDeleted()) {
            return response("success");
        } else {
            return response("error: delete panel");
        }
    }

}
