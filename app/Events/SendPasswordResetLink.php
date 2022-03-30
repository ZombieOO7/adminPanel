<?php

namespace App\Events;

use App\Models\Admin;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendPasswordResetLink
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $token;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Admin $user,$token)
    {
        $this->user= $user;
        $this->token = $token;
    }
}
