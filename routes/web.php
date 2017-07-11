<?php


Route::get("/login", ["as" => "login.get", "uses" => "ViewController@getLoginView"]);

Route::post("/login", ["as" => "login.post", "uses" => "RegisterController@register"]);

Route::get("/maintenance", ["as" => "maintenance", "uses" => "ViewController@getMaintenancePage"]);

Route::group(["middleware" => ["app"]], function() {
	
	Route::get('/', ["as" => "index.get", "uses" => "ViewController@index"]);

	
});

