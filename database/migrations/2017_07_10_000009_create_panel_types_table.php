<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePanelTypesTable extends Migration
{
    /**
     * Run the migrations.
     * @table panel_types
     *
     * @return void
     */
    public function up()
    {
        Schema::create('panel_types', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 45);

            $table->unique(["id"], 'id_UNIQUE');

            $table->unique(["name"], 'name_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists('panel_types');
     }
}
