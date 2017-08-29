<?php

use Illuminate\Database\Seeder;


class CopyOldNewsSeeder extends Seeder {
	

	public function run() {

		$sp9_news_array = File::getRequire('database/seeds/sp9_news_array.php');

		$news = [];
		$array_length = sizeof($sp9_news_array);
		foreach ($sp9_news_array as $sp9_news_row) {

			$sp9_news_row["news_news"] = str_replace("div", "p", $sp9_news_row["news_news"]);
			$sp9_news_row["news_news"] = str_replace("<strong", "<p><b", $sp9_news_row["news_news"]);
			$sp9_news_row["news_news"] = str_replace("</strong>", "</b></p>", $sp9_news_row["news_news"]);
			$sp9_news_row["news_news"] = str_replace("<font", "<p", $sp9_news_row["news_news"]);
			$sp9_news_row["news_news"] = str_replace("</font>", "</p>", $sp9_news_row["news_news"]);
			$sp9_news_row["news_news"] = stripcslashes($sp9_news_row["news_news"]);
			
			array_push($news,
				["id" => $sp9_news_row["news_id"],
				"title" => $sp9_news_row["news_subject"],
				"content" => $sp9_news_row["news_news"] . $sp9_news_row["news_extended"],
				"slug" => str_slug($sp9_news_row["news_subject"] . $sp9_news_row["news_id"]),
				"created_by" => 1,
				"published_at" => $sp9_news_row["news_datestamp"],
				"expire_at" => $sp9_news_row["news_end"], 
				"is_public" => 1,
				"created_at" => $sp9_news_row["news_datestamp"],
				"updated_at" => null,
				"news_reads" => $sp9_news_row["news_reads"]]
				);         
		}

		foreach ($news as $array) {
			if(!DB::table("news")->find($array["id"])) {
				DB::table("news")->insert($array); 
			}
		}
	}
}
