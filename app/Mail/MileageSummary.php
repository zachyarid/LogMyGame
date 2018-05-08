<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MileageSummary extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $mileage;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mileage, User $user)
    {
        $this->mileage = $mileage;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.mileage-summary');
    }
}
