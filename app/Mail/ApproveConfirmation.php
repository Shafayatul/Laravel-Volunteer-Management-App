<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApproveConfirmation extends Mailable
{
    use Queueable, SerializesModels;
    public $id;
    public $opportunity;
    public $message;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id, $opportunity, $message)
    {
        $this->id = $id;
        $this->opportunity = $opportunity;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.approve-confirmation');
    }
}
