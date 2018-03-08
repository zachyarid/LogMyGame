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
            $table->integer('game_id')->nullable(true)->unsigned();
            $table->integer('user_id')->unsigned();
            $table->date('date_travel')->nullable(true);
            $table->string('origin');
            $table->integer('odometer_out')->nullable(true);
            $table->integer('odometer_in')->nullable(true);
            $table->integer('distance')->nullable(true);
            $table->text('comments')->nullable(true);
            $table->string('status')->nullable(true);
            $table->timestamps();
            $table->softDeletes();
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
