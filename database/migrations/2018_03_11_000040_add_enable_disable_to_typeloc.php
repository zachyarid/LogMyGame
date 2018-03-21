<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEnableDisableToTypeloc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('game_types', function (Blueprint $table) {
            $table->integer('disabled')->default(0)->after('is_default');
        });

        Schema::table('game_locations', function (Blueprint $table) {
            $table->integer('disabled')->default(0)->after('is_default');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('game_types', function (Blueprint $table) {
            $table->dropColumn('disabled');
        });

        Schema::table('game_locations', function (Blueprint $table) {
            $table->dropColumn('disabled');
        });
    }
}
