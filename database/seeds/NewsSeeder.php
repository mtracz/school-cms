<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class NewsSeeder extends Seeder
{

	public function run() {

		$faker = Faker\Factory::create("pl_PL");

		$news = [];

		$recordsCount = 50;

		for($i = 0; $i < $recordsCount; $i++) {
			array_push(
				$news,
				["id" => $i+1, "title" => $faker->realText(20,1), "content" => "<p>". $faker->realText(1000,1) ."</p>", "slug" => $faker->unique()->word, "created_by" => 1, "published_at" => $this->getRandomDate(), "expire_at" => null, "is_public" => 1, "created_at" => $this->getRandomDate(), "updated_at" => $this->getRandomDate()]
				);
		}

		Schema::disableForeignKeyConstraints();

		foreach ($news as $array) {
			if(!DB::table("news")->find($array["id"])) {
				DB::table("news")->insert($array); 
			}
		}
	}

	public function getRandomDate() {

		$string = date("Y-m-d H:i:s", mt_rand());

		return $string;
	}

}
