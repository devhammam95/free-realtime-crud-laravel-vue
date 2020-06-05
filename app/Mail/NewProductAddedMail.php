<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewProductAddedMail extends Mailable
{
    use Queueable, SerializesModels;
     public $title;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title)
    {
        //
        $this->title = $title;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $msg = "new product is added";
        return $this->view('mails.productAdded')
                    ->subject('new product added')
                    ->from("hello@sdasd.com")
                    ->with(['title'=>$this->title,'msg'=>$msg]);
    }
}
