<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     * @table menu_items
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 45);
            $table->integer('order')->nullable();
            $table->unsignedInteger('menu_id');
            $table->tinyInteger('is_dropdown')->default('0');

            $table->index(["menu_id"], 'fk_menu_items_menu1_idx');

            $table->unique(["id"], 'id_UNIQUE');


            $table->foreign('menu_id', 'fk_menu_items_menu1_idx')
                ->references('id')->on('menu')
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
       Schema::dropIfExists('menu_items');
     }
}
