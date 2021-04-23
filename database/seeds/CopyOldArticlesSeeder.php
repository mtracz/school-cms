<?php

use Illuminate\Database\Seeder;

// use App\Models\StaticPage;

class CopyOldArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$sp9 = File::getRequire('database/seeds/sp9_articles_array.php');
    	$pages = [];

    	foreach($sp9 as $row) {

    		$row["article_article"] = str_replace("div", "p", $row["article_article"]);
    		$row["article_article"] = str_replace("<strong", "<p><b", $row["article_article"]);
    		$row["article_article"] = str_replace("</strong>", "</b></p>", $row["article_article"]);
    		$row["article_article"] = str_replace("<font", "<p", $row["article_article"]);
            $row["article_article"] = str_replace("</font>", "</p>", $row["article_article"]);
            $row["article_article"] = str_replace("<table", "<table class='ui table' ", $row["article_article"]);
    		$row["article_article"] = str_replace("/images", "/images_old", $row["article_article"]);
    		$row["article_article"] = stripcslashes($row["article_article"]);

    		array_push($pages, [
    			"id" => $row["article_id"],
    			"title" => $row["article_subject"],
    			"content" => $row["article_article"],
    			"slug" => str_slug($row["article_subject"]),
    			"created_by" => 1,
    			"is_public" => 1,
    			"created_at" => date("Y-m-d H:i:s",$row["article_datestamp"]),
    			"updated_at" => null,
    			"page_reads" => $row["article_reads"],
    			]);
    	}

    	Schema::disableForeignKeyConstraints();

		foreach ($pages as $array) {
			if(!DB::table("static_pages")->find($array["id"])) {
				DB::table("static_pages")->insert($array); 
			}
		}
    }
}
