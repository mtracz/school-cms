<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsPinnedTable extends Migration
{
    /**
     * Run the migrations.
     * @table news_pinned
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_pinned', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('news_id');

            $table->index(["news_id"], 'fk_news_pinned_news_idx');

            $table->unique(["id"], 'id_UNIQUE');


            $table->foreign('news_id', 'fk_news_pinned_news_idx')
                ->references('id')->on('news')
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
       Schema::dropIfExists('news_pinned');
     }
}
