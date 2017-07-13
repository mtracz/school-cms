<?php 

use Illuminate\Database\Seeder;

class ActionTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $action_types = [

        	["id" => 1, "name" => "Zalogowano", "color" => "white"],
    		["id" => 2, "name" => "Nie udane logowanie", "color" => "#EEE657"],
    		["id" => 3, "name" => "Wylogowano", "color" => "#83D6DE"],
    		["id" => 4, "name" => "Dodano", "color" => "green"],
    		["id" => 5, "name" => "Edytowano", "color" => "orange"],
    		["id" => 6, "name" => "Usunięto", "color" => "red"],
    		["id" => 7, "name" => "Włączono tryb serwisowy", "color" => "#888888"],  		    		
    		["id" => 8, "name" => "Wyłączono tryb serwisowy", "color" => "#D4D4D4"],		
    	];

    	Schema::disableForeignKeyConstraints();

		 foreach ($action_types as $array) {

			if(!DB::table("action_types")->find($array["id"])) {
				 DB::table("action_types")->insert($array); 
			}
		}
    }
}