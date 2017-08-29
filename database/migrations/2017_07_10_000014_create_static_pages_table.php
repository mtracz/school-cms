<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaticPagesTable extends Migration
{
    /**
     * Run the migrations.
     * @table static_pages
     *
     * @return void
     */
    public function up()
    {
        Schema::create('static_pages', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 45);
            $table->text('content');
            $table->string('slug', 45);
            $table->unsignedInteger('created_by');
            $table->tinyInteger('is_public')->default('1');
            $table->timestamps();
            $table->unsignedInteger('page_reads')->nullable();

            $table->index(["created_by"], 'fk_articles_admins1_idx');

            $table->unique(["id"], 'id_UNIQUE');

            $table->unique(["slug"], 'slug_UNIQUE');


            $table->foreign('created_by', 'fk_articles_admins1_idx')
                ->references('id')->on('admins')
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
       Schema::dropIfExists('static_pages');
     }
}
