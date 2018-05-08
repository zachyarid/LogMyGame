<?php

namespace App\Jobs;

use App\Mail\GameSummary;
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

class ProcessGameSummaryEmails implements ShouldQueue
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
        Log::info('[GS] Starting Job: ProcessGameSummaryEmails');
        $now = Carbon::now();

        $users = User::where([
            'game_summary' => 1,
            'email_toggle' => 1,
        ])->get();

        if (count($users) > 0) {
            foreach ($users as $user) {
                $date = empty($user->gamesummary_last_run)
                    ? Carbon::parse($user->created_at)->midDay()
                    : Carbon::parse($user->gamesummary_last_run)->midDay();

                $nextRun = $date->copy()->addDays($user->game_summary_freq);

                $seconds = $nextRun->diffInSeconds($now, false);

                if ($seconds >= 0) {
                    $sum = [];
                    $qualGames = DB::table('games')
                        ->select('id')
                        ->where([
                            ['user_id', '=', $user->id],
                        ])
                        ->whereBetween('date', [$date->format('Y-m-d'), $nextRun->format('Y-m-d')])
                        ->get();
                    foreach ($qualGames as $g) {
                        $sum[] = $g->id;
                    }

                    $games = $user->games->whereIn('id', $sum);

                    Mail::to($user)->queue(new GameSummary($games, $user));  # include sort on mail blade

                    //Set the gamesummary_last_run to now
                    $user->gamesummary_last_run = $now->format('Y-m-d H:i:s');
                    $user->save();
                    Log::info('[GS] Email queued / last_run updated for user_id: ' . $user->id);
                } else {
                    Log::info('[GS] Next run for user_id: ' . $user->id . ' is ' . $nextRun->format('Y-m-d'));
                }
            }
        }
        else {
            Log::info('[GS] No users have email toggle on');
        }
    }
}
