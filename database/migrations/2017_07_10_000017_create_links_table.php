<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     * @table links
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('url');
            $table->integer('order')->nullable();
            $table->unsignedInteger('menu_item_id')->nullable();

            $table->index(["menu_item_id"], 'fk_links_menu_items1_idx');

            $table->unique(["id"], 'id_UNIQUE');


            $table->foreign('menu_item_id', 'fk_links_menu_items1_idx')
                ->references('id')->on('menu_items')
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
       Schema::dropIfExists('links');
     }
}
