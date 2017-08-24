<?php

namespace App\Services;

use App\Models\News;
use App\Models\Admin;

class NewsManageService {

	protected $converter_array = [
	"publish_at_date" => "published_at",
	"expire_at_date" => "expire_at",
	"created_at_date" => "created_at",
	"updated_at_date" => "updated_at",
	"title" => "title",
	"author" => "created_by",
		// "is_public" => true,
	];

	public function __construct() {
		
	}

	public function pluckNews($request) {
		
		$params = $this->prepareParametersArray($request);

		$news_plucked = News::where($params)->get();

		return $news_plucked;
	}

	protected function prepareParametersArray($parameters) {
		
		$query_array;

		$is_public = $this->isNewsPublic($parameters["status"]);
		$admin_id = $this->getAdminId($parameters["author"]);

		$query_array = [];

		$query_array = [
			["published_at", ">=", $parameters["publish_at_date_parsed"]],
			["expire_at", "<", $parameters["expire_at_date_parsed"]],
			["created_at", "like", $parameters["created_at_date_parsed"] . "%"],
			["updated_at", "like", $parameters["updated_at_date_parsed"] . "%"],
			["title", "like", "%" . $parameters["title"] . "%"],
			["created_by", "=", $admin_id],
			["is_public", "=", $is_public],
		];

		$count = count($query_array);

		for($i = 0; $i < $count; $i++) {
			
			if(! isset($query_array[$i][2])) {

				unset($query_array[$i]);
			}
		}

		return $query_array;
	}

	public function isNewsPublic($status) {
		if($status != null) {
			if($status == "public") {
				return 1;
			} else { 
				if($status == "private") {
					return 0;
				}
			}
		} else {
			return $status;
		}
		
	}

	public function getAdminId($name) {

		$id = Admin::where("name", "=", $name)->get();

		if($id->isEmpty()) {
			return null;
		} else {
			$id = $id->toArray()[0]["id"];
		}

		return $id;
	}
}