<?php

namespace App\Console\Commands;

use App\EmailRequest;
use App\Jobs\SendEmailJob;
use App\UserWebsiteSubscription;
use App\WebsitePost;
use Illuminate\Console\Command;

class CommandSendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:send-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command is to send email on new post';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $new_posts = WebsitePost::where("sent_to_subscribers", "=", 0)->get();
        foreach ($new_posts as $new_post){
            $subscribers = UserWebsiteSubscription::with("user")->where("website_id", $new_post->website_id)
                ->get();
            foreach ($subscribers as $subscriber){

                $data = array(
                    "name"=>$subscriber->user->name,
                    "email"=>$subscriber->user->email,
                    "text"=>$new_post->post_text,
                    );

                $emailJob = (new SendEmailJob($data));

                dispatch($emailJob);

                $subscriber_sent_data = array("user_id"=>$subscriber->user->id, "post_id"=>$new_post->id);
                EmailRequest::create($subscriber_sent_data);
            }

            $new_post->sent_to_subscribers =1;
            $new_post->save();

        }

    }
}
