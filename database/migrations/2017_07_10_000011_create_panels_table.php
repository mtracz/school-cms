<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePanelsTable extends Migration
{
    /**
     * Run the migrations.
     * @table panels
     *
     * @return void
     */
    public function up()
    {
        Schema::create('panels', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 45);
            $table->string('header')->nullable();
            $table->text('content');
            $table->unsignedInteger('panel_type_id');
            $table->tinyInteger('has_header')->default('1');

            $table->unique(["id"], 'id_UNIQUE');

            $table->unique(["name"], 'name_UNIQUE');

            $table->unique(["panel_type_id"], 'panel_types_id_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists('panels');
     }
}
