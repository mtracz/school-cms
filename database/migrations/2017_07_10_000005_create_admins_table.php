<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
	/**
	 * Run the migrations.
	 * @table admins
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admins', function (Blueprint $table) {
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('login', 45);
			$table->string('password');
			$table->string('name');
			$table->tinyInteger('is_super_admin')->default('0');
			$table->tinyInteger('is_active')->default('1');
			$table->timestamps();

			$table->unique(["id"], 'id_UNIQUE');

			$table->unique(["login"], 'login_UNIQUE');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	 public function down()
	 {
	   Schema::dropIfExists('admins');
	 }
}
