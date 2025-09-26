<?php

namespace App\Notifications;

use App\Models\Notification as ModelsNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class ServiceProviderContractExpiring extends Notification implements ShouldQueue
{
    use Queueable;

    public $providerName;
    public $contractEndDate;

    /**
     * Create a new notification instance.
     */
    public function __construct($providerName, $contractEndDate)
    {
        $this->providerName = $providerName;
        $this->contractEndDate = $contractEndDate;
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
    public static function createForRecipients($providerName, $contractEndDate, $recipients)
    {
        $notification = ModelsNotification::create([
            'title' => 'Service Provider Contract Expiring Soon',
            'body' => "{$providerName}'s contract will expire on {$contractEndDate}.",
            'send_to' => 'specific',
            'auto_notification' => '1',
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
            'title' => 'Service Provider Contract Expiring Soon',
            'body' => "{$this->providerName}'s contract will expire on {$this->contractEndDate}.",
        ]);
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
