<?php

use Illuminate\Database\Seeder;

use App\Models\SiteSector;

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

			["id" => SiteSector::TOP_1, "name" => "top_1", "panels_types_allowed_ids" => "2;3;", "is_menu_allowed" => 1, "orientation_id" => "1"],
			["id" => SiteSector::TOP_2, "name" => "top_2", "panels_types_allowed_ids" => "2;3;", "is_menu_allowed" => 1, "orientation_id" => "1"],
			["id" => SiteSector::TOP_3, "name" => "top_3", "panels_types_allowed_ids" => "2;3;", "is_menu_allowed" => 1, "orientation_id" => "1"],
			["id" => SiteSector::LEFT, "name" => "left", "panels_types_allowed_ids" => "1;2;4;5;6;7;", "is_menu_allowed" => 1, "orientation_id" => "2"],
			["id" => SiteSector::RIGHT, "name" => "right", "panels_types_allowed_ids" => "1;2;4;5;6;7;", "is_menu_allowed" => 1, "orientation_id" => "2"],
			["id" => SiteSector::BOTTOM, "name" => "bottom", "panels_types_allowed_ids" => "1;2;5;6;7;", "is_menu_allowed" => 0, "orientation_id" => "1"],
		];

		Schema::disableForeignKeyConstraints();

		 foreach ($site_sectors as $array) {

			if(!DB::table("site_sectors")->find($array["id"])) {
				 DB::table("site_sectors")->insert($array); 
			}
		}
    }
}
