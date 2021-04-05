<?php

namespace App\Events;

use App\Models\Semester;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SemesterCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The semester instance.
     *
     * @var App\Models\Semester
     */
    public $semester;

    /**
     * Create a new event instance.
     *
     * @param  App\Models\Semester $semester
     * @return void
     */
    public function __construct(Semester $semester)
    {
        $this->semester = $semester;
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
