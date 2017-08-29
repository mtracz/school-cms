<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     * @table news
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->text('content');
            $table->string('slug');
            $table->unsignedInteger('news_category_id')->nullable();
            $table->unsignedInteger('created_by');
            $table->timestamp('published_at')->nullable();
            $table->timestamp('expire_at')->nullable();
            $table->tinyInteger('is_public')->default('1');
            $table->timestamps();
            $table->unsignedInteger('news_reads')->nullable();

            $table->index(["created_by"], 'fk_news_admins2_idx');

            $table->index(["news_category_id"], 'fk_news_news_categories1_idx');

            $table->unique(["id"], 'id_UNIQUE');

            $table->unique(["slug"], 'slug_UNIQUE');


            $table->foreign('created_by', 'fk_news_admins2_idx')
                ->references('id')->on('admins')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('news_category_id', 'fk_news_news_categories1_idx')
                ->references('id')->on('news_categories')
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
       Schema::dropIfExists('news');
     }
}
