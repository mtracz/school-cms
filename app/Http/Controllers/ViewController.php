<?php

namespace App\Http\Controllers;

use Request;

use App\Models\Admin;
use App\Models\Settings;
use App\Models\Log;

class ViewController extends Controller {
    public function index() {
        $log = Log::find(1);

    	return view("welcome")->with("log", $log);
    }

    public function getLoginView() {
    	$super_admin = Admin::where("is_super_admin", 1)->first();

    	if($super_admin) {
    		// super admin created in past
    		return view("admin_login");
    	} else {
    		// super admin not created - first login
    		return view("admin_create");
       	}    	
    }

    public function getMaintenancePage() {



        return view("maintenance");
    }
}
