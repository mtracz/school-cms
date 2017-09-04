<?php

namespace App\Services;

use App\Models\Element;

class ElementsUpdateService { 

	public function saveChanges($elements) {

		foreach ($elements as $elem) {

			$row = Element::findOrFail($elem["id"]);

			if($row) {

				$row->site_sector_id = intval($elem["sector_id"]);
				$row->order = intval($elem["order"]);
				$row->is_enabled = intval($elem["is_enabled"]);

				$row->save();
			}
		}
	}
}