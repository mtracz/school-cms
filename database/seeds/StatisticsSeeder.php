<?php

use Illuminate\Database\Seeder;

class StatisticsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statistics = [

			["id" => 1, "name" => "unique_visits", "value" => 0],
			["id" => 2, "name" => "news_count", "value" => 0],
			["id" => 3, "name" => "static_pages_count", "value" => 0],
			["id" => 4, "name" => "published_news", "value" => 0],
			["id" => 5, "name" => "unpiblished_news", "value" => 0],
		];

		Schema::disableForeignKeyConstraints();

		 foreach ($statistics as $array) {

			if(!DB::table("statistics")->find($array["id"])) {
				 DB::table("statistics")->insert($array); 
			}
		}
    }
}
