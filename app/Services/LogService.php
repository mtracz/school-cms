<?php 

namespace App\Services;

use App\Models\Log;
use Auth;

class LogService {

	protected $actor_id;
	protected $actor_name;
	protected $action;

	public static function createLog(string $input_text) {
		$LogServiceObject = (new LogService())
			->checkActor()
			->prepareActionText($input_text)
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

	protected function prepareActionText($input_text) {
		$find = ";";
		$replace = "<br>";
		$this->action = $this->actor_name . $replace;
		$formated_text = str_replace($find, $replace, $input_text);
		$this->action .= $formated_text;
		return $this;
	}

	protected function writeLogInDatabase() {
		$log_object = new Log();
		$log_object->action = $this->action;
		$log_object->actor_id = $this->actor_id;
		$log_object->save();
	}
}