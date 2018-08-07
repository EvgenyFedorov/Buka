<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function(Blueprint $table){

            $table->increments('id');
            $table->integer('diller_id');
            $table->string('model_id');
            $table->string('model_name');
            $table->string('equipment_name');
            //$table->integer('existence');
            $table->integer('price');
            $table->string('exterior_color');
            $table->string('interior_color');
            //$table->integer('status_action');
            //$table->text('description_action');
            $table->string('internal_code');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
