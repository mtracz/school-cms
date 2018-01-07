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

			["id" => 1, "name" => "font_size_standard", "value" => 0],
			["id" => 2, "name" => "font_size_big", "value" => 0.5],
			["id" => 3, "name" => "font_size_biggest", "value" => 1],
			["id" => 4, "name" => "admin_email", "value" => "info@sp9.legnica.pl"],
			["id" => 5, "name" => "news_per_page", "value" => 7],
			["id" => 6, "name" => "cookie_text", "value" => "Ten serwis wykorzystuje pliki cookies. Korzystanie z witryny oznacza zgodę na ich zapis lub odczyt wg ustawień przeglądarki."],
			["id" => 7, "name" => "is_maintenance_mode", "value" => 0],
			["id" => 8, "name" => "maintenance_mode_text", "value" => "Tryb serwisowy. Spróbuj później."],
			["id" => 9, "name" => "title", "value" => "Oficjalna strona Szkoły Podstawowej nr 9 w Legnicy"],
			["id" => 10, "name" => "description", "value" => "Szkoła Podstawowa nr 9 w Legnicy, edukacja"],
			["id" => 11, "name" => "keywords", "value" => "sp9, sp9legnica, szkołapodstawowanr9wlegnicy, szkołapodstawowanr9legnica, szkołapodstawowa, legnicasp9wlegnicy, sp, 9, legnica, szkoła, podstawowa,sp 9, sp9, sp 9 legnica, sp9 legnica, szkoła podstawowa nr 9 w legnicy, szkoła podstawowa nr 9 legnica, szkoła podstawowa, legnica sp 9 w legnicy, sp9 w legnicy, szkoła podstawowa, legnica, biblioteka, samorząd uczniowski, plan lekcji, gazetka szkolna, wykaz podręczników, dziewiątka"],
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
