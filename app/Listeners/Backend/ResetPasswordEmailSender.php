<?php

namespace App\Listeners\Backend;

use Mail;
use App\Events\Backend\ResetPasswordEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPasswordEmailSender
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
     * @param  ResetPasswordEvent  $event
     * @return void
     */
    public function handle(ResetPasswordEvent $event)
    {
        $user = $event->user;
        $reminder = $event->reminder;

        $data = [
            'email' => $user->email,
            'name' => $user->first_name.' '.$user->last_name,
            'subject' => 'Reset Your Password',
            'code' => $reminder->code,
            'id' => $user->id,
        ];

        Mail::queue('backend.emails.reset-password', $data, function ($message) use ($data) {
            $message->to($data['email'], $data['name'])->subject($data['subject']);
        });
    }
}
