<?php

namespace App\Listeners;

use App\Events\MessagesInsert;
use App\Jobs\MessageQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TwittersEventSubscribe
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
     * @param  MessagesInsert  $event
     * @return void
     */
    public function handle(MessagesInsert $event)
    {
        MessageQueue::dispatch($event->twitters);
    }
}
