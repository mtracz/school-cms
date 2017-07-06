<?php

namespace App\Http\Controllers;

use Request;

class ViewController extends Controller {
    public function index() {
    	return view("welcome");
    }
}
