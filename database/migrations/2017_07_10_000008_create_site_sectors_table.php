<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteSectorsTable extends Migration
{
    /**
     * Run the migrations.
     * @table site_sectors
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_sectors', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('panels_allowed_ids')->nullable();
            $table->tinyInteger('is_menu_allowed')->nullable();

            $table->unique(["id"], 'id_UNIQUE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists('site_sectors');
     }
}
