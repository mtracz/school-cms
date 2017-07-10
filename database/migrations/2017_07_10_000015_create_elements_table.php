<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElementsTable extends Migration
{
    /**
     * Run the migrations.
     * @table elements
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elements', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('site_sector_id')->nullable();
            $table->unsignedInteger('order');
            $table->unsignedInteger('panel_id')->nullable();
            $table->unsignedInteger('menu_id')->nullable();
            $table->tinyInteger('is_enabled')->nullable();

            $table->index(["panel_id"], 'fk_elements_panels1_idx');

            $table->index(["site_sector_id"], 'fk_elements_site_sectors1_idx');

            $table->index(["menu_id"], 'fk_elements_menu1_idx');

            $table->unique(["id"], 'id_UNIQUE');


            $table->foreign('site_sector_id', 'fk_elements_site_sectors1_idx')
                ->references('id')->on('site_sectors')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('menu_id', 'fk_elements_menu1_idx')
                ->references('id')->on('menu')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('panel_id', 'fk_elements_panels1_idx')
                ->references('id')->on('panels')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists('elements');
     }
}
