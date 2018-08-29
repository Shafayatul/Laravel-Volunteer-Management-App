<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewOpportunity extends Mailable
{
    use Queueable, SerializesModels;
    public $id;
    public $opportunity;
    public $teacher_name;
    public $school_name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id, $opportunity, $teacher_name, $school_name)
    {
        $this->id = $id;
        $this->opportunity = $opportunity;
        $this->teacher_name = $teacher_name;
        $this->school_name = $school_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.new-opportunity');
    }
}
