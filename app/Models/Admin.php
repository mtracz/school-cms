<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Admin;
use App\Models\StaticPage;
use App\Models\Event;

class Admin extends Authenticatable {
	use Notifiable;

	use SoftDeletes;

	protected $dates = ['deleted_at'];

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


	public function is_active() {
		return $this->is_active;
	}

	public function is_super_admin() {
		return $this->is_super_admin;
	}

	public function news() {
		return $this->hasMany(Admin::class);
	}

	public function static_page() {
		return $this->hasMany(StaticPage::class);
	}

	public function event() {
		return $this->hasMany(Event::class);
	}
}
