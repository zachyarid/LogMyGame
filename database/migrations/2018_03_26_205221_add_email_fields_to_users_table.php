<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmailFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('game_summary')->default(1)->after('email_toggle');
            $table->integer('game_summary_freq')->default(7)->after('game_summary');
            $table->timestamp('gamesummary_last_run')->nullable()->after('game_summary_freq');
            $table->integer('outstanding_payments')->default(1)->after('game_summary_last_run');
            $table->integer('outstanding_freq')->default(3)->after('outstanding_payments');
            $table->timestamp('outstanding_last_run')->nullable()->after('outstanding_freq');
            $table->integer('mileage_summary')->default(1)->after('outstanding_last_run');
            $table->integer('mileage_summary_freq')->default(7)->after('mileage_summary');
            $table->timestamp('mileage_last_run')->nullable()->after('mileage_summary_freq');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'game_summary',
                'game_summary_freq',
                'gamesummary_last_run',
                'outstanding_payments',
                'outstanding_freq',
                'outstanding_last_run',
                'mileage_summary',
                'mileage_summary_freq',
                'mileage_last_run'
            ]);
        });
    }
}
