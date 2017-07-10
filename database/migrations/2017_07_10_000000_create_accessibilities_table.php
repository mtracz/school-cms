<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessibilitiesTable extends Migration
{
    /**
     * Run the migrations.
     * @table accessibilities
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accessibilities', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 45);
            $table->unsignedTinyInteger('is_enabled')->default('1');

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
       Schema::dropIfExists('accessibilities');
     }
}
