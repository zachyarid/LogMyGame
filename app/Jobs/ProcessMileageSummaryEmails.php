<?php

namespace App\Jobs;

use App\Mail\MileageSummary;
use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ProcessMileageSummaryEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('[MS] Starting Job: ProcessMileageSummaryEmails');
        $now = Carbon::now();

        $users = User::where([
            'mileage_summary' => 1,
            'email_toggle' => 1,
        ])->get();

        if (count($users) > 0) {
            foreach ($users as $user) {
                $date = empty($user->mileage_last_run)
                    ? Carbon::parse($user->created_at)->midDay()
                    : Carbon::parse($user->mileage_last_run)->midDay();

                $nextRun = $date->copy()->addDays($user->mileage_summary_freq);

                $seconds = $nextRun->diffInSeconds($now, false);

                if ($seconds >= 0) {
                    $sum = [];
                    $qualMileage = DB::table('mileage')
                        ->select('id')
                        ->where([
                            ['user_id', '=', $user->id],
                        ])
                        ->whereBetween('date_travel', [$date->format('Y-m-d'), $nextRun->format('Y-m-d')])
                        ->get();
                    foreach ($qualMileage as $m) {
                        $sum[] = $m->id;
                    }

                    $mileage = $user->mileage->whereIn('id', $sum);

                    Mail::to($user)->queue(new MileageSummary($mileage, $user));  # include sort on mail blade

                    //Set the mileage_last_run to now
                    $user->mileage_last_run = $now->format('Y-m-d H:i:s');
                    $user->save();
                    Log::info('[MS] Email queued / last_run updated for user_id: ' . $user->id);
                } else {
                    Log::info('[MS] Next run for user_id: ' . $user->id . ' is ' . $nextRun->format('Y-m-d'));
                }
            }
        } else {
            Log::info('[MS] No users have email toggle on');
        }
    }
}
