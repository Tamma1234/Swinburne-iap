<?php

namespace App\Jobs;

use App\Mail\SendMailable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EventMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $email;
    protected $name;
    protected $campus_code;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $campus_code)
    {
        $this->email = $email;
        $this->campus_code = $campus_code;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        config(['database.default' => $this->campus_code]);

        $email = $this->email;
        Mail::to($email)->send(new SendMailable($email));
    }
}
