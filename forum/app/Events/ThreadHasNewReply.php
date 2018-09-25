<?php

namespace App\Events;


use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;


class ThreadHasNewReply
{
    use SerializesModels;

    public $thread;

    public $reply;

    /**
     * Create a new event instance.
     *
     * @param Thread $thread
     * @param Reply $reply
     */
    public function __construct($thread, $reply)
    {
        $this->thread = $thread;
        $this->reply  = $reply;
    }


}
