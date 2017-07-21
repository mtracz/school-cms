<?php 

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContentToolsController extends Controller {

	public function uploadImage(Request $request) {
		dd($request->all());
	}

}