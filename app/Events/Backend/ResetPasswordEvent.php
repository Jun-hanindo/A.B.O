<?php

namespace App\Events\Backend;

use App\Models\User;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Cartalyst\Sentinel\Reminders\EloquentReminder as Reminder;

class ResetPasswordEvent extends Event
{
    use SerializesModels;

    /**
     * User's object.
     * 
     * @var \Cartalyst\Sentinel\Users\UserInterface
     */
    public $user;

    /**
     * Reminder's object.
     * 
     * @var \Reminder
     */
    public $reminder;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Reminder $reminder)
    {
        $this->user = $user;
        $this->reminder = $reminder;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
