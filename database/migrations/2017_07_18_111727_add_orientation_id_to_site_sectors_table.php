<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOrientationIdToSiteSectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('site_sectors', function (Blueprint $table) {

            $table->unsignedInteger('orientation_id')->nullable();

            //$table->index(["orientation_id"], 'orientation_id_foreign');

            $table->foreign('orientation_id')
                ->references('id')->on('orientations')
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
        Schema::table('site_sectors', function (Blueprint $table) {
            $table->dropForeign('site_sectors_orientation_id_foreign');
        });
    }
}
