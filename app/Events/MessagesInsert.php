<?php

namespace App\Events;

use App\Models\Twitters;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessagesInsert
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $twitters;
    /**
     * Create a new event instance.
     *
     * @param array $twitters
     */
    public function __construct(array $twitters)
    {
        $this->twitters = $twitters;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
