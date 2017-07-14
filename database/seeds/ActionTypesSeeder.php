<?php 

use Illuminate\Database\Seeder;
use App\Models\Log;

class ActionTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $action_types = [

        	["id" => Log::LOGIN_SUCCESS, "name" => "Zalogowano", "color" => "#FFFFFF"],
    		["id" => Log::LOGIN_FAIL, "name" => "Nie udane logowanie", "color" => "#EEE657"],
    		["id" => Log::LOGOUT, "name" => "Wylogowano", "color" => "#83D6DE"],
    		["id" => Log::ADD, "name" => "Dodano", "color" => "#00e500"],
    		["id" => Log::EDIT, "name" => "Edytowano", "color" => "#FFA500"],
    		["id" => Log::DELETE, "name" => "Usunięto", "color" => "#FF0000"],
    		["id" => Log::MAINTENANCE_ON, "name" => "Włączono tryb serwisowy", "color" => "#888888"],  		    		
            ["id" => Log::MAINTENANCE_OFF, "name" => "Wyłączono tryb serwisowy", "color" => "#D4D4D4"],        
    		["id" => Log::OTHER, "name" => "Inne", "color" => "#1BA39C"],		
    	];

    	Schema::disableForeignKeyConstraints();

		 foreach ($action_types as $array) {

			if(!DB::table("action_types")->find($array["id"])) {
				 DB::table("action_types")->insert($array); 
			}
		}
    }
}