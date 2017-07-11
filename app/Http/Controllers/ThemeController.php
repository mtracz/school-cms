<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\ThemeService;

class ThemeController extends Controller {

	public function getTheme() {

		$themeService = new ThemeService();

		$themeData = $themeService->getThemeData();

		return $themeData;
	}

}
