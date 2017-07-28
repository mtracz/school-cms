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

Route::get("/test", function(){
	return view("test");
});

//ALL USERS

// MAIN PAGE
Route::get('/', ["as" => "index.get", "uses" => "ViewController@index"]);

// PAGES NEWS
Route::get('/page/{slug}', ["as" => "page.get", "uses" => "StaticPageController@getStaticPage"]);

// MAINTENANCE PAGE
Route::get("/maintenance", ["as" => "maintenance", "uses" => "ViewController@getMaintenancePage"]);

// SITE SETTINGS

Route::get('/settings/show', ["as" => "settings.show.get", "uses" => "SettingsController@getSettings"]);
Route::post('/settings/set', ["as" => "settings.set.post", "uses" => "SettingsController@setSettings"]);

Route::post('/password/change', ["as" => "password.change.post", "uses" => "SettingsController@changePassword"]);

// form news preview
Route::get('/news/add', ["as" => "news.add.get", "uses" => "ViewController@getNewsForm"]);
Route::post('/news/add', ["as" => "news.add.post", "uses" => "NewsController@addNews"]);

Route::get('/settings', ["as" => "settings.get", "uses" => "ViewController@getSettings"]);


Route::post('/content_tools/upload_image', ["as" => "content_tools.image.upload.post", "uses" => "ContentToolsController@uploadImage"]);

Route::post('/content_tools/rotate_image', ["as" => "content_tools.image.rotate.post", "uses" => "ContentToolsController@rotateImage"]);

Route::post('/content_tools/save_image', ["as" => "content_tools.image.save.post", "uses" => "ContentToolsController@saveImage"]);


