<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeLogsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('logs', function (Blueprint $table) {	
			$table->dropColumn("action");
			$table->text("content");
			$table->unsignedInteger("action_type_id");
			$table->index("action_type_id");

			$table->foreign("action_type_id")
				->references('id')->on('action_types')
				->onDelete('no action')
				->onUpdate('no action');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('logs', function (Blueprint $table) { 
			$table->text("action");
			$table->dropForeign(["action_type_id"]);
			$table->dropColumn(["content", "action_type_id"]);
		});
	}
}
