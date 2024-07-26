<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class YourMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $title;
    public $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title,$content)
    {
        $this->content = $content;
        $this->title = $title;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.notifications.mail')
            ->subject($this->title)
            ->with([
                'content' => $this->content,
            ]);
    }
}
