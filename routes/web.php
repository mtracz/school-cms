<?php

// NON LOGGED USERS
Route::group(["middleware" => ["guest"]], function() {

	// LOGIN VIEW
	Route::get("/login", ["as" => "login.get", "uses" => "ViewController@getLoginView"]);

	// REGISTER SUPER ADMIN
	Route::post("/login_create", ["as" => "register.post", "uses" => "Auth\RegisterController@register"]);

	// LOGIN ADMIN
	Route::post("/login", ["as" => "login.post", "uses" => "Auth\LoginController@login"]);	

	// MAINTENANCE PAGE
	Route::get("/maintenance", ["as" => "maintenance", "uses" => "ViewController@getMaintenancePage"]);

	// SITE SETTINGS
	Route::get('/settings', ["as" => "settings.get", "uses" => "SettingsController@getSettings"]);

	// SITE THEMES
	Route::get('/theme', ["as" => "theme.get", "uses" => "ThemeController@getTheme"]);


});

// MAINTENANCE MIDDLEWARE
	Route::group(["middleware" => ["app"]], function() {

		// MAIN PAGE
		Route::get('/', ["as" => "index.get", "uses" => "ViewController@index"]);
		
	});

// LOGGED USERS
Route::group(["middleware" => ["auth"]], function() {

	// LOGOUT ADMIN
	Route::post("/logout", ["as" => "logout.post", "uses" => "Auth\LoginController@logout"]);

});
