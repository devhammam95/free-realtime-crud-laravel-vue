<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AddNewProduct implements ShouldBroadcast
{
   // use Dispatchable, InteractsWithSockets, SerializesModels;
    use Dispatchable, InteractsWithSockets;
    public $product,$status,$name;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($status,$product,$name)
    {
        //
        $this->product = $product;
        $this->name    = $name;
        $this->status  = $status;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('product-index');
    }
}
