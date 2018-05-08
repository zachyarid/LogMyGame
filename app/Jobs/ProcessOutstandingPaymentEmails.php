<?php

namespace App\Jobs;

use App\User;
use App\Mail\OutstandingPayments;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ProcessOutstandingPaymentEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function handle()
    {
        Log::info("[OP] Starting Job: ProcessOutstandingPaymentEmails");
        $now = Carbon::now();

        $users = User::where([
            'outstanding_payments' => 1,
            'email_toggle' => 1,
        ])->get();


        if (count($users) > 0) {
            foreach ($users as $user) {
                $date = empty($user->outstanding_last_run)
                    ? Carbon::parse($user->created_at)->midDay()
                    : Carbon::parse($user->outstanding_last_run)->midDay();

                $nextRun = $date->copy()->addDays($user->outstanding_freq);

                $seconds = $nextRun->diffInSeconds($now, false);

                if ($seconds >= 0) {
                    $pd = [];
                    $payments = $user->payments;
                    foreach ($payments as $p) {
                        $pd[] = $p->game_id;
                    }

                    $gamesNotPaid = $user->games->whereNotIn('id', $pd); # include sort on mail blade

                    Mail::to($user)->queue(new OutstandingPayments($gamesNotPaid, $user));

                    // Set the outstanding_last_run to now
                    $user->outstanding_last_run = $now->format('Y-m-d H:i:s');
                    $user->save();
                    Log::info('[OP] Email queued / last_run updated for user_id: ' . $user->id);
                } else {
                    Log::info('[OP] Next run for user_id: ' . $user->id . ' is ' . $nextRun->format('Y-m-d'));
                }
            }
        } else {
            Log::info('[OP] No users have email toggle on');
        }
    }
}
