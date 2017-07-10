<?php

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$settings = [

			["id" => 1, "name" => "font_size_default", "value" => 0],
			["id" => 2, "name" => "font_size_big", "value" => 2],
			["id" => 3, "name" => "font_size_biggest", "value" => 4],
			["id" => 4, "name" => "admin_email", "value" => ""],
			["id" => 5, "name" => "news_per_page", "value" => 10],
			["id" => 6, "name" => "coockie_text", "value" => "Ten serwis wykorzystuje pliki cookies. Korzystanie z witryny oznacza zgodę na ich zapis lub odczyt wg ustawień przeglądarki."],
			["id" => 7, "name" => "is_maintenance_mode", "value" => 0],
			["id" => 8, "name" => "maintenance_mode_text", "value" => "Fuck off, get lost!"],
			["id" => 9, "name" => "title", "value" => "Set title"],
			["id" => 10, "name" => "description", "value" => ""],
			["id" => 11, "name" => "keywords", "value" => ""],
			["id" => 12, "name" => "theme", "value" => "Default"],
			
		];

		Schema::disableForeignKeyConstraints();

		 foreach ($settings as $array) {

			if(!DB::table("settings")->find($array["id"])) {
				 DB::table("settings")->insert($array); 
			}
		}
	}
}
