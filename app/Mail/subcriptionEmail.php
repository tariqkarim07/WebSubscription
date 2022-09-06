<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class subcriptionEmail extends Mailable
{
    use Queueable, SerializesModels;

     protected $email_data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email_data)
    {
        $this->email_data = $email_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env("MAIL_FROM"), env("MAIL_FROM_NAME"))
            ->subject('New Post Added')
            ->view($this->text)->with(['email_data'=>$this->email_data]);
    }
}
