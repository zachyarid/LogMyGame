<?php

namespace App\Console;

use App\Jobs\ProcessMileageSummaryEmails;
use App\Jobs\ProcessOutstandingPaymentEmails;
use App\Jobs\ProcessGameSummaryEmails;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->job(new ProcessGameSummaryEmails)->twiceDaily(12, 13);
        $schedule->job(new ProcessOutstandingPaymentEmails)->twiceDaily(12, 13);
        $schedule->job(new ProcessMileageSummaryEmails)->twiceDaily(12, 13);
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
