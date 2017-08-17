<?php

namespace App\Http\Controllers;

use Request;
use Session;

use App\Models\Admin;
use App\Models\News;
use App\Models\NewsPinned;
use App\Models\Theme;

use App\Http\Controllers\SettingsController;

use Carbon\Carbon;

class ViewController extends Controller {
    public function index() {

        $news_pinned = NewsPinned::first();

        $news;

        if($news_pinned) {

            $news = News::orderBy("published_at", "desc")
                ->where("published_at", "<=", Carbon::now()->toDateTimeString())
                ->whereNull("expire_at")
                ->where("is_public","1")
                ->where("id", "<>", $news_pinned->news_id)
                ->orWhere(function ($query) {
                    $query->where("published_at", "<=", Carbon::now()->toDateTimeString())
                        ->where("expire_at", ">", Carbon::now()->toDateTimeString())
                        ->where("is_public","1");
                })
                ->get();
        } else {

            $news = News::orderBy("published_at", "desc")
                ->where("published_at", "<=", Carbon::now()->toDateTimeString())
                ->whereNull("expire_at")
                ->where("is_public","1")
                ->orWhere(function ($query) {
                    $query->where("published_at", "<=", Carbon::now()->toDateTimeString())
                        ->whereNull("expire_at", ">", Carbon::now()->toDateTimeString())
                        ->where("is_public","1");
                })
                ->get();
        }

        return view("mainLayout")
            ->with("news", $news)
            ->with("news_pinned", $news_pinned);
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


    public function getNewsFormAdd() {
        $newsPinnedObject = NewsPinned::first();
        return view("addNews")->with("newsPinned", $newsPinnedObject);
    }

    public function getNewsFormEdit($id) {
        $editing_news = News::find($id);
        if(!$editing_news) {
            Session::flash("messages", ["Nie znaleziono newsa o podanym ID" => "error" ]);
            return redirect()->route("index.get");
        }
        $newsPinnedObject = NewsPinned::first();
        return view("addNews")->with("editing_news", $editing_news)
                            ->with("newsPinned", $newsPinnedObject);
    }

    public function getSettings() {
        
        $settingsController = new SettingsController();

        $settings = $settingsController->getSettings();
        $themes = Theme::all();

        return view("settings")->with("settings", $settings)->with("themes", $themes);
    }

}
