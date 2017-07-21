<?php

namespace App\Http\Controllers;

use Request;

use App\Models\Admin;
use App\Models\News;
use App\Models\NewsPinned;

class ViewController extends Controller {
    public function index() {

        $news_data = News::all();

    	return view("mainLayout")->with("news", $news_data);

    	// return view("welcome");        
    	// return view("mainLayout")->with("content_elements", $news_data);
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


    public function getNewsForm() {
        $newsPinnedObject = NewsPinned::first();
        return view("addNews")->with("newsPinned", $newsPinnedObject);
    }

}
