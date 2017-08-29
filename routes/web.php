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

// MAINTENANCE PAGE
Route::get("/maintenance", ["as" => "maintenance", "uses" => "ViewController@getMaintenancePage"]);

// SITE SETTINGS

Route::get('/settings/show', ["as" => "settings.show.get", "uses" => "SettingsController@getSettings"]);
Route::post('/settings/set', ["as" => "settings.set.post", "uses" => "SettingsController@setSettings"]);

Route::post('/password/change', ["as" => "password.change.post", "uses" => "SettingsController@changePassword"]);
//NEWS//
// news add view
Route::get('/news/add', ["as" => "news.add.get", "uses" => "ViewController@getNewsFormAdd"]);
// news add
Route::post('/news/add', ["as" => "news.add.post", "uses" => "NewsController@addNews"]);

//news edit view
Route::get('/news/edit/{id}', ["as" => "news.edit.get", "uses" => "ViewController@getNewsFormEdit"]);
//news edit 
Route::post('/news/edit/{id}', ["as" => "news.edit.post", "uses" => "NewsController@editNews"]);

// news delete
// //change to post
Route::post('/news/delete/{id}', ["as" => "news.delete.get", "uses" => "NewsController@deleteNews"]);

// news manage
Route::get("/news/manage", ["as" => "news.manage.get", "uses" => "ViewController@getNewsManagePage"]);

//STATIC PAGES//
//show page
Route::get('/pages/{slug}', ["as" => "pages.show.get", "uses" => "ViewController@getPageView"]);

//static page add view
Route::get('/page/add', ["as" => "page.add.get", "uses" => "ViewController@getPageFormAdd"]);
// page add
Route::post('/page/add', ["as" => "page.add.post", "uses" => "PageController@addPage"]);

//page edit view
Route::get('/page/edit/{id}', ["as" => "page.edit.get", "uses" => "ViewController@getPageFormEdit"]);
//page edit 
Route::post('/page/edit/{id}', ["as" => "page.edit.post", "uses" => "PageController@editPage"]);

// page delete
// //change to post
Route::post('/page/delete/{id}', ["as" => "page.delete.post", "uses" => "PageController@deletePage"]);

//page manage
Route::get('/page/manage', ["as" => "page.manage.get", "uses" => "ViewController@getPagesManagePage"]);

// FILES
// add
Route::post("file/add", ["as" => "file.add.post", "uses" => "FileController@addFile"]);
// get files list
Route::get("file/list", ["as" => "file.list.get", "uses" => "FileController@getAllFilesFromServer"]);
// manage
Route::get("file/manage", ["as" => "file.manage.get", "uses" => "ViewController@getFilesManagePage"]);
// delete
Route::post("file/delete/{name}", ["as" => "file.delete.post", "uses" => "FileController@deleteFile"]);

// ELEMENTS
// manage
Route::get("element/manage", ["as" => "element.manage.get", "uses" => "ViewController@getElementsManagePage"]);

// settings
Route::get('/settings', ["as" => "settings.get", "uses" => "ViewController@getSettings"]);

// content tools
Route::post('/content_tools/upload_image', ["as" => "content_tools.image.upload.post", "uses" => "ContentToolsController@uploadImage"]);

Route::post('/content_tools/rotate_image', ["as" => "content_tools.image.rotate.post", "uses" => "ContentToolsController@rotateImage"]);

Route::post('/content_tools/save_image', ["as" => "content_tools.image.save.post", "uses" => "ContentToolsController@saveImage"]);

// SITE ELEMENTS
// menu add view
Route::get("/elements/menu/add", ["as" => "menu.add.get", "uses" => "ViewController@getMenuAddView"]);

