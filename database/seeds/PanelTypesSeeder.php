<?php

use Illuminate\Database\Seeder;

class PanelTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $panel_types = [

        	["id" => 1, "name" => "custom"],
        	["id" => 2, "name" => "banner"],
    		["id" => 3, "name" => "accessibilites"],
    		["id" => 4, "name" => "info"],
    		["id" => 5, "name" => "list"],
    		
    	];

    	Schema::disableForeignKeyConstraints();

		 foreach ($panel_types as $array) {

			if(!DB::table("panel_types")->find($array["id"])) {
				 DB::table("panel_types")->insert($array); 
			}
		}
    }
}
