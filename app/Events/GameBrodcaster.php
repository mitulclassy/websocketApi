<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GameBrodcaster  implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $gameId="";
    private $channel='match-';
    private $data=[];
    private $type="";
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($gameId,$type="",$data=[])
    {
       $this->gameId=$gameId;
       $this->channel.=$gameId;
        $this->data = (count($data)>0)?$data:['game Started'];
        $this->type=$type;
       // dd($this);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel($this->channel);
    }
    public function broadcastWith()
    {

        return $this->data;
    }

    public function broadcastAs()
    {
        return $this->type;
    }
}
