<?php 

namespace App\Helpers;

use Cookie;

use App\Models\Statistics;


class VisitHelper {

	protected $cookie_unique_visit_expire_time;

	public function checkUniqueVisitCookie() {
		return Cookie::get("cms_unique_visit");
	}

	public function createUniqueVisitCookie() {		
		$this->setUniqueVisitCookieExpireTime();
		Cookie::queue(Cookie::make("cms_unique_visit", "true", $this->cookie_unique_visit_expire_time));
	}

	public function updateUniqueVisits() {
		Statistics::where("name", "unique_visits")->increment("value");
	}

	protected function setUniqueVisitCookieExpireTime() {
		$years = 10;
		$days = 365;
		$hours = 24;
		$minuts = 60;
		$this->cookie_unique_visit_expire_time = $years * $days * $hours * $minuts;
	}
}