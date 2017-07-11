<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Admin;
use App\Models\StaticPage;
use App\Models\Event;

class Admin extends Authenticatable {
	use Notifiable;

	protected $table = "admins";

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'login', 'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
	];


	public function news() {

		$this->hasMany(Admin::class);
	}

	public function static_page() {
		
		$this->hasMany(StaticPages::class);
	}

	public function event() {
		
		$this->hasMany(Event::class);
	}
}
