<?php


Route::get("/login", ["as" => "login.get", "uses" => "ViewController@getLoginView"]);
Route::get("/maintenance", ["as" => "maintenance", "uses" => "ViewController@getMaintenancePage"]);

Route::group(["middleware" => ["app"]], function() {
	
	Route::get('/', ["as" => "index.get", "uses" => "ViewController@index"]);

	
});