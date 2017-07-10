<?php

use Illuminate\Database\Seeder;

class ThemesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $themes = [

			["id" => 1, "name" => "Default", "color_1" => "#29475f", "color_2" => "#457393", "color_3" => "#c7b29b", "color_4" => "#7ecefd", "color_5" => "#2f88a7"],
			["id" => 2, "name" => "Contrast", "color_1" => "#f1c40f", "color_2" => "#2c3e50", "color_3" => "#34495e", "color_4" => "#34495e", "color_5" => "#34495e"],
		];

		Schema::disableForeignKeyConstraints();

		 foreach ($themes as $array) {

			if(!DB::table("themes")->find($array["id"])) {
				 DB::table("themes")->insert($array); 
			}
		}
    }
}
