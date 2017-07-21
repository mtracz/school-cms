<?php

use Illuminate\Database\Seeder;

use App\Model\Orientations;

class OrientationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $orientations = [

			["id" => 1, "name" => "horizontal"],
			["id" => 2, "name" => "vertical"],
		];

		Schema::disableForeignKeyConstraints();

		 foreach ($orientations as $array) {

			if(!DB::table("orientations")->find($array["id"])) {
				 DB::table("orientations")->insert($array); 
			}
		}
    }
}
