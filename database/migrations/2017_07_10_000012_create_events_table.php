<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     * @table events
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->text('content');
            $table->timestamp('started_at');
            $table->timestamp('ended_at')->nullable()->default(null);
            $table->tinyInteger('is_annual')->nullable();
            $table->tinyInteger('is_monthly')->nullable();
            $table->tinyInteger('is_daily')->nullable();
            $table->unsignedInteger('created_by');
            $table->timestamps();

            $table->index(["created_by"], 'fk_events_admins1_idx');

            $table->unique(["id"], 'id_UNIQUE');


            $table->foreign('created_by', 'fk_events_admins1_idx')
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
       Schema::dropIfExists('events');
     }
}
