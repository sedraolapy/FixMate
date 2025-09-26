<?php

namespace App\Notifications;

use App\Models\Notification as ModelsNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class AddNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $title;
    public $body;
    public $sendTo;
    public $autoNotification;
    public $date;
    public $time;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        string $title,
        string $body,
        string $sendTo = 'all',
        bool $autoNotification = true,
        string $date = null,
        string $time = null
    ) {
        $this->title = $title;
        $this->body = $body;
        $this->sendTo = $sendTo;
        $this->autoNotification = $autoNotification;
        $this->date = $date ?? now()->toDateString();
        $this->time = $time ?? now()->toTimeString();
    }

    /**
     * Only broadcast for real-time notifications
     */
    public function via($notifiable)
    {
        return ['broadcast'];
    }

    /**
     * Create a notification and attach recipients
     */
    public static function createForRecipients(
        string $title,
        string $body,
        $recipients = [],
        string $sendTo = 'specific'
    ): ModelsNotification {
        $notification = ModelsNotification::create([
            'title' => $title,
            'body' => $body,
            'send_to' => $sendTo,
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
            'title' => $this->title,
            'body' => $this->body,
        ]);
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
