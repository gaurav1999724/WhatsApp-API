<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;
    public function __construct(Message $message)
    {
        $this->message = $message;
        \Log::info('MessageSent event created >>>>> ', ['message' => $message]);
    }

    public function broadcastOn()
    {
        try{
            \Log::info('chatroom_id >>>>> '.json_encode($this->message->chatroom_id));

            return new Channel('chatroom.' . $this->message->chatroom_id);
        }catch (\Throwable $th) {
            \Log::info('MessageSent status >>>>> '.json_encode($th->getMessage()));

            return Response(['status' => 500, 'status_text' => $th->getMessage()], 500);
            throw $th;
        }
    }

    
}
