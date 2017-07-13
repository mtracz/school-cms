<?php 

namespace App\Services;

use App\Models\Log;
use Auth;

class LogService {

	protected $actor_id;
	protected $actor_name;
	protected $action_type_id;
	protected $content ="";
	protected $action_types = [];

	public function __construct() {
		// MAPPING action types
		// ["input_acton_in_string" => "id_action_in_database"]
		$this->action_types[
			"1" => "login_success",
			"2" => "login_fail",
			"3" => "logout",
			"4" => "add",
			"5" => "edit",
			"6" => "delete",
			"7" => "maintenance_on",
			"8" => "maintenance_off",
			];
	}

	public static function createLog(string $action, string $content_text) {
		$this->content = $content_text;
		$LogServiceObject = (new LogService())
			->checkActor()
			->checkActionType($action)
			->writeLogInDatabase();
	}

	protected function checkActor() {
		if(Auth::user()) {
			$this->actor_id = Auth::user()->id;
			$this->actor_name = Auth::user()->name;
		} else {
			$this->actor_id = 0;
			$this->actor_name = "non logged user";
		}
		return $this;
	}

	protected function writeLogInDatabase() {
		$log_object = new Log();
		$log_object->actor_id = $this->actor_id;

		dd(Log::where("action_type_id", $this->action_type_id)->first()->actionType->name);

		$log_object->action = Log::where("action_type_id", $this->action_type_id)->first()->actionType->name;

		$log_object->content = $this->content;
		$log_object->save();
	}

	protected function checkActionType($action) {
		$this->action_type_id = array_search($action, $this->action_types); 
		return $this;
	}

}