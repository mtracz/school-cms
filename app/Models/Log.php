<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\ActionType;

class Log extends Model {
    protected $table = "logs";
    const UPDATED_AT = null;

    public function actionType() {
    	return $this->belongsTo(ActionType::class);
    }
}
