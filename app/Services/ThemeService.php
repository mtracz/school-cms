<?php

namespace App\Services;

use DB;

use App\Models\Theme;

class ThemeService {

	public function getThemeData() {
		$theme = Theme::all()->toArray();

		$theme_data = json_decode(json_encode($theme));

		return $theme_data;
	}
}