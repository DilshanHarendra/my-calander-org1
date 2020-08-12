<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegisteredForEvent extends Mailable
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
            ->view('email.event.registered')
            ->subject("You've registered for ".$this->event->title)
            ->with([
                'event' => $this->event,
            ]);
    }
}
