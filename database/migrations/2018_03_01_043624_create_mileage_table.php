<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMileageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mileage', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('game_id')->unsigned();
            //rel
            $table->integer('user_id')->unsigned();
            //rel
            $table->integer('odometer_out');
            $table->integer('odometer_in');
            $table->integer('distance');
            $table->text('comments')->nullable();
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
        Schema::dropIfExists('mileage');
    }
}
