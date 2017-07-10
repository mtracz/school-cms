<?php

Route::get('/', ["as" => "index.get", "uses" => "ViewController@index"]);

Route::get("/login", ["as" => "login.get", "uses" => "ViewController@getLoginView"]);
