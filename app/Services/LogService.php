<?php 

namespace App\Services;

use Auth;

use App\Models\Log;

class LogService {

	protected $actor_id;
	protected $actor_name;
	protected $action_type_id;
	protected $content = "";

	protected static function createLog($action_id, string $content_text) {
		
		$LogServiceObject = new LogService();
		$LogServiceObject->content = $content_text;
		$LogServiceObject->action_type_id = $action_id;

		$LogServiceObject->checkActor()
			->writeLogInDatabase();
	}

	public static function LoginSuccess(string $content) {
		self::createLog(Log::LOGIN_SUCCESS, $content);
	}

	public static function LoginFail(string $content) {
		self::createLog(Log::LOGIN_FAIL, $content);
	}

	public static function Logout(string $content) {
		self::createLog(Log::LOGOUT, $content);
	}

	public static function Add(string $content) {
		self::createLog(Log::ADD, $content);
	}

	public static function Edit(string $content) {
		self::createLog(Log::EDIT, $content);
	}

	public static function Delete(string $content) {
		self::createLog(Log::DELETE, $content);
	}

	public static function MaintenanceOn(string $content) {
		self::createLog(Log::MAINTENANCE_ON, $content);
	}

	public static function MaintenanceOff(string $content) {
		self::createLog(Log::MAINTENANCE_OFF, $content);
	}

	public static function Other(string $content) {
		self::createLog(Log::OTHER, $content);
	}

	protected function checkActor() {
		if(Auth::user()) {
			$this->actor_id = Auth::user()->id;
			$this->actor_name = Auth::user()->name;
		} else {
			$this->actor_id = 0;
			$this->actor_name = "Niezalogowany";
		}
		return $this;
	}

	protected function writeLogInDatabase() {

		$log_object = new Log();
		$log_object->actor_id = $this->actor_id;
		$log_object->action_type_id = $this->action_type_id;
		$log_object->content = $this->actor_name . "; " . $this->content;
		$log_object->save();
	}

}