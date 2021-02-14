<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmailMailable;
use Throwable;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $tries = 5;//Pokusaji za izvrsavanje job-a.
    protected $user;
    public function __construct($user)
    {
        $this->user = $user;
        $this->onQueue('register_email_notification');//Specific queue.
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to("example@example.com")->send(new SendEmailMailable($this->user));
    }

    public function failed(Throwable $exception)
    {
        $message = "Email sending failed.";
        $response = array(
            "message" => $message,
            "Errors" => $exception,
        );
        
        return response()->json($response);
    }

}
