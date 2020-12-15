<?php

namespace App\Events;

use App\Media;
use App\VideoGame;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class VideoGameCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var VideoGame
     */
    public $videoGame;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(VideoGame $videoGame)
    {
        Log::info("Created video game with ID: " . $videoGame->id);
        Media::create([
                "title" => $videoGame->original_title,
                "grantable_id" => $videoGame->id,
                "grantable_type" => "App\VideoGame",
                "delivery_platform_id" => 0,
                
                

            ]
        );
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
