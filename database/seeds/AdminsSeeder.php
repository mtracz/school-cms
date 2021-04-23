<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $admins = [
    		[
    		"id" => 1, 
    		"login" => "admin",
    		"password" => bcrypt("admin"),
    		"name" => "TestAdmin", 
    		"is_super_admin" => 1, 
    		"is_active" => 1, 
    		"created_at" => Carbon::now(),
    		"updated_at" => Carbon::now(),
    		],
    	];

    	Schema::disableForeignKeyConstraints();

		 foreach ($admins as $array) {

			if(!DB::table("admins")->find($array["id"])) {
				 DB::table("admins")->insert($array); 
			}
		}
    }
}
