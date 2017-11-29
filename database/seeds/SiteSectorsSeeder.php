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

    		// ["id" => 1, "name" => "custom"],
  //   		// ["id" => 2, "name" => "search"],
  //   		["id" => 3, "name" => "banner"],
  //   		// ["id" => 4, "name" => "accessibilites"],
  //   		["id" => 5, "name" => "info"],
  //   		// ["id" => 6, "name" => "google_maps"],
  //   		["id" => 7, "name" => "list"],

        $site_sectors = [
        	//removed panel type id : 2
			["id" => SiteSector::TOP_1, "name" => "top_1", "panels_types_allowed_ids" => "3;", "is_menu_allowed" => 1, "orientation_id" => "1"],
			//removed panel type id : 2
			["id" => SiteSector::TOP_2, "name" => "top_2", "panels_types_allowed_ids" => "3;", "is_menu_allowed" => 1, "orientation_id" => "1"],
			//removed panel type id : 2
			["id" => SiteSector::TOP_3, "name" => "top_3", "panels_types_allowed_ids" => "3;", "is_menu_allowed" => 1, "orientation_id" => "1"],
			//removed panel type id : 2,4,6
			["id" => SiteSector::LEFT, "name" => "left", "panels_types_allowed_ids" => "1;5;7;", "is_menu_allowed" => 1, "orientation_id" => "2"],
			//removed panel type id : 2,4,6
			["id" => SiteSector::RIGHT, "name" => "right", "panels_types_allowed_ids" => "1;5;7;", "is_menu_allowed" => 1, "orientation_id" => "2"],
			//removed panel type id : 2,6
			["id" => SiteSector::BOTTOM, "name" => "bottom", "panels_types_allowed_ids" => "1;5;7;", "is_menu_allowed" => 0, "orientation_id" => "1"],
		];

		Schema::disableForeignKeyConstraints();

		 foreach ($site_sectors as $array) {

			if(!DB::table("site_sectors")->find($array["id"])) {
				 DB::table("site_sectors")->insert($array); 
			}
		}
    }
}
