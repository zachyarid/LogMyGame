<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GameSummary extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $games;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($games, User $user)
    {
        $this->games = $games;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.game-summary');
    }
}
