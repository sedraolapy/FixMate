<?php

namespace App\Notifications;

use App\Models\Notification as ModelsNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class ContactUsSubmitted extends Notification implements ShouldQueue
{
    use Queueable;

    public $feedbackId;

    /**
     * Create a new notification instance.
     */
    public function __construct($feedbackId)
    {
        $this->feedbackId = $feedbackId;
    }

    /**
     * Only broadcast for real-time notifications
     */
    public function via($notifiable)
    {
        return ['broadcast'];
    }

    /**
     * Manually create notification and attach recipients
     */
    public static function createForRecipients($feedbackId, $recipients)
    {
        $notification = ModelsNotification::create([
            'title' => 'New Contact Us Request',
            'body' => "A user submitted a message.",
            'send_to' => 'specific',
            'auto_notification' => 1,
            'date' => now()->toDateString(),
            'time' => now()->toTimeString(),
        ]);

        foreach ($recipients as $recipient) {
            $notification->recipients()->create([
                'recipient_id' => $recipient->id,
                'recipient_type' => get_class($recipient),
            ]);
        }

        return $notification;
    }

    /**
     * Broadcast real-time payload
     */
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'title' => 'New Contact Us Request',
            'body' => "A user submitted a message.",
            'feedback_id' => $this->feedbackId,
        ]);
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
