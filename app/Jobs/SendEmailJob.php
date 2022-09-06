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
        Mail::to($this->email_data['email'])->send(new subcriptionEmail($this->email_data));
    }

}
