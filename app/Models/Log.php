<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\ActionType;

class Log extends Model {
    protected $table = "logs";
    const UPDATED_AT = null;

	const LOGIN_SUCCESS = 1;
	const LOGIN_FAIL = 2;
	const LOGOUT = 3;
	const ADD = 4;
	const EDIT = 5;
	const DELETE = 6;
	const MAINTENANCE_ON = 7;
	const MAINTENANCE_OFF = 8;
	const OTHER = 9;

    public function action() {
    	return $this->belongsTo(ActionType::class);
    }
}
