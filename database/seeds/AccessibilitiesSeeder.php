<?php

use Illuminate\Database\Seeder;

class AccessibilitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

    	$accessibilities = [

    		["id" => 1, "name" => "font", "is_enabled" => 1],
    		["id" => 2, "name" => "contrast", "is_enabled" => 1],
    	];

    	Schema::disableForeignKeyConstraints();

		 foreach ($accessibilities as $array) {

			if(!DB::table("accessibilities")->find($array["id"])) {
				 DB::table("accessibilities")->insert($array); 
			}
		}
    }
}
