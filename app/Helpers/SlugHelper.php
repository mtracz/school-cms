<?php 

namespace App\Helpers;

class SlugHelper {

	public static function createSlug($string) {
		$separator = "-";
		return str_slug($string, $separator);
	}
}