<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteUserToEvent extends Mailable
{
    use Queueable, SerializesModels;

    private $event;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($event)
    {
        $this->event = $event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('info@o2ocalendar.com' , 'O2O Calendar')
            ->view('email.event.invite')
            ->subject("New event invitation")
            ->with([
                'event' => $this->event,
            ]);
    }
}
