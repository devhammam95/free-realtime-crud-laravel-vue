<?php

namespace App\Jobs;

use App\Mail\NewProductAddedMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class NewProductAdded implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $name;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        $this->name= $name;
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $to    = env('MAIL_TO_ADDRESS_ON_ADDED_PRODUCTS','devhammam95@gmail.com');
        $title = $this->name;
        Mail::to($to)->send(new NewProductAddedMail($title));
    }
}
