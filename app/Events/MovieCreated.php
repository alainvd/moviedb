<?php

namespace App\Events;

use App\Media;
use App\Movie;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MovieCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Movie
     */
    public $movie;


    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Movie $movie)
    {
        Log::info("Created movie with ID: " . $movie->id);
        Media::create([
                "title" => $movie->original_title,
                "grantable_id" => $movie->id,
                "grantable_type" => "App\Movie",
                "audience_id" => null,
                "genre_id" => null,
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
