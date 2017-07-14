<?php

namespace App\Http\Controllers;

use Request;

use App\Models\Admin;
use App\Models\Settings;

class ViewController extends Controller {
    public function index() {


        $settings_data = Settings::all();

    	return view("mainLayout")->with("element", $settings_data);

    	// return view("mainLayout");

    	//return view("welcome");
    }

    public function test() {

        return view("test");
    }

    public function getLoginView() {
    	$super_admin = Admin::where("is_super_admin", 1)->first();

    	if($super_admin) {
    		// super admin created in past
    		return view("adminLogin");
    	} else {
    		// super admin not created - first login
    		return view("adminCreate");
       	}    	
    }

    public function getMaintenancePage() {

        return view("maintenance");
    }
}
