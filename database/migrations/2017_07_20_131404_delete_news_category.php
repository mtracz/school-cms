<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteNewsCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('news', function (Blueprint $table) { 
            // $table->dropForeign(["news_category_id"]);
            $table->dropForeign("fk_news_news_categories1_idx");
            $table->dropColumn("news_category_id");
        });
        //delete news categories table
        Schema::drop('news_categories');       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //create news categories table
        Schema::create('news_categories', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');

            $table->unique(["id"], 'id_UNIQUE');
        });

        Schema::table('news', function (Blueprint $table) { 
            $table->unsignedInteger('news_category_id')->nullable();
            $table->foreign('news_category_id', 'fk_news_news_categories1_idx')
                ->references('id')->on('news_categories')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }
}
