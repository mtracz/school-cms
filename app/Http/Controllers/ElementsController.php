<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\ElementsUpdateService;

class ElementsController extends Controller
{
    public function updateElements(Request $request) {

    	$elements = $request->all();

    	$elementsUpdateService = new ElementsUpdateService();
    	$elementsUpdateService->saveChanges($elements["data"]);

    	dump($elements);
    }
}
