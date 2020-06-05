<?php

namespace App\Listeners;
use App\Events\AddNewProduct;
use App\Events\SendOperationOnProduct;
use App\Jobs\NewProductAdded;
use App\Mail\NewProductAddedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NewProductCreated implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(SendOperationOnProduct $event)
    {
        if ($event->status=='added'){
            $product= $event->product;
            dispatch(new NewProductAdded($product->name));
        }
    }
}
