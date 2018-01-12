<?php

use Illuminate\Database\Seeder;


class CopyOldNewsSeeder extends Seeder {
	

	public function run() {

		$sp9_news_array = File::getRequire('database/seeds/sp9_news_array.php');    	

		$news = [];
		$array_length = sizeof($sp9_news_array);

		foreach ($sp9_news_array as $sp9_news_row) {

			$temp_row = $sp9_news_row["news_news"] . $sp9_news_row["news_extended"];

        	// REPLACE <DIV> to <P>
			$temp_row = str_replace("div", "p", $temp_row);
        	// REPLACE '\\'
			$temp_row = stripcslashes($temp_row);

        	// REPLACE <STRONG> to <P><B>
			$temp_row = str_replace("<strong", "<p><b", $temp_row);
			$temp_row = str_replace("</strong>", "</b></p>", $temp_row);

        	// REPLACE <FONT>
			$temp_row = str_replace("<font", "<p", $temp_row);
			$temp_row = str_replace("</font>", "</p>", $temp_row);

			// REPLACE <TABLE to semantic ui table class
			$temp_row = str_replace("<table", "<table class='ui table' ", $temp_row);

			array_push($news,
				["id" => $sp9_news_row["news_id"],
				"title" => $sp9_news_row["news_subject"],
				"content" => $temp_row,
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
