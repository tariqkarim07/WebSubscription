<?php

namespace App\Jobs;

use App\Mail\subcriptionEmail;
use Illuminate\Support\Facades\Mail;

class SendEmailJob extends Job
{

    protected  $email_data;
    public function __construct($email_data)
    {
        $this->email_data = $email_data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $template = 'emails.new_post_email';
        Mail::send($template, ['data' => $this->email_data], function ($mail)  {
            $mail->from(env("MAIL_FROM_ADDRESS"), env("MAIL_FROM_NAME"))->to($this->email_data['email'])->subject("New Post Added");
        });
    }

}
