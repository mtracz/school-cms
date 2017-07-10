<?php

use Illuminate\Database\Seeder;

class SiteSectorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $site_sectors = [

			["id" => 1, "name" => "top_1", "panels_allowed_ids" => "", "is_menu_allowed" => 1],
			["id" => 2, "name" => "top_2", "panels_allowed_ids" => "", "is_menu_allowed" => 1],
			["id" => 3, "name" => "top_3", "panels_allowed_ids" => "", "is_menu_allowed" => 1],
			["id" => 4, "name" => "left", "panels_allowed_ids" => "", "is_menu_allowed" => 1],
			["id" => 5, "name" => "right", "panels_allowed_ids" => "", "is_menu_allowed" => 1],
			["id" => 6, "name" => "bottom", "panels_allowed_ids" => "", "is_menu_allowed" => 0],
		];

		Schema::disableForeignKeyConstraints();

		 foreach ($site_sectors as $array) {

			if(!DB::table("site_sectors")->find($array["id"])) {
				 DB::table("site_sectors")->insert($array); 
			}
		}
    }
}
