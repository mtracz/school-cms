<?php

// NON LOGGED USERS
Route::group(["middleware" => ["guest"]], function() {

	// LOGIN VIEW
	Route::get("/login", ["as" => "login.get", "uses" => "ViewController@getLoginView"]);

	// REGISTER SUPER ADMIN
	Route::post("/login_create", ["as" => "register.post", "uses" => "Auth\RegisterController@register"]);

	// LOGIN ADMIN
	Route::post("/login", ["as" => "login.post", "uses" => "Auth\LoginController@login"]);

	// SITE THEMES
	Route::get('/theme', ["as" => "theme.get", "uses" => "ThemeController@getTheme"]);

});

// LOGGED USERS
Route::group(["middleware" => ["auth"]], function() {

	// LOGOUT ADMIN
	Route::post("/logout", ["as" => "logout.post", "uses" => "Auth\LoginController@logout"]);

});


Route::get("/global", ["as" => "global.get", "uses" => "GlobalController@serve"]);

//ALL USERS

// MAIN PAGE
Route::get('/', ["as" => "index.get", "uses" => "ViewController@index"]);

// MAINTENANCE PAGE
Route::get("/maintenance", ["as" => "maintenance", "uses" => "ViewController@getMaintenancePage"]);

// SITE SETTINGS
	Route::get('/settings', ["as" => "settings.get", "uses" => "SettingsController@getSettings"]);

