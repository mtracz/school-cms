<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRememberTokenToAdminsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('admins', function (Blueprint $table) {
			$table->string("remember_token")->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		if(Schema::hasColumn("admins","remember_token")) {
			Schema::table('admins', function (Blueprint $table) {
				$table->dropColumn("remember_token");
				}); 
		}
	}
}
