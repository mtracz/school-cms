<?php

use Illuminate\Database\Seeder;

class CopyOldSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sp9 = File::getRequire('database\seeds\sp9_settings_array.php');

    	$settings = [

			["id" => 1, "name" => "font_size_default", "value" => 0],
			["id" => 2, "name" => "font_size_big", "value" => 2],
			["id" => 3, "name" => "font_size_biggest", "value" => 4],
			["id" => 4, "name" => "admin_email", "value" => ""],
			["id" => 5, "name" => "news_per_page", "value" => 10],
			["id" => 6, "name" => "cookie_text", "value" => "Ten serwis wykorzystuje pliki cookies. Korzystanie z witryny oznacza zgodę na ich zapis lub odczyt wg ustawień przeglądarki."],
			["id" => 7, "name" => "is_maintenance_mode", "value" => $sp9[0]["maintenance"]],
			["id" => 8, "name" => "maintenance_mode_text", "value" => $sp9[0]["maintenance_message"]],
			["id" => 9, "name" => "title", "value" => $sp9[0]["sitename"]],
			["id" => 10, "name" => "description", "value" => $sp9[0]["description"]],
			["id" => 11, "name" => "keywords", "value" => "sp9, sp9legnica, szkołapodstawowanr9wlegnicy, szkołapodstawowanr9legnica, szkołapodstawowa, legnicasp9wlegnicy, sp, 9, legnica, szkoła, podstawowa,sp 9,sp9, sp 9 legnica, sp9 legnica"],
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
