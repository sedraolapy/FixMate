<?php

namespace App\Notifications;

use App\Models\Notification as ModelsNotification;
use App\Models\Offer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class NewOfferNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $offer;

    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
    }

    /**
     * Only broadcasting for real-time notifications
     */
    public function via($notifiable)
    {
        return ['broadcast'];
    }

    /**
     * Manually create notification and attach recipient
     */
    public static function createForRecipients(Offer $offer, $recipients)
    {
        $notification = ModelsNotification::create([
            'title' => 'New Offer Available',
            'body' => "A new offer '{$offer->title}' is available from {$offer->serviceProvider->name}.",
            'send_to' => 'specific',
            'auto_notification' => 0,
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
            'title' => 'New Offer Available',
            'body' => "A new offer '{$this->offer->title}' is available from {$this->offer->serviceProvider->name}.",
            'offer_id' => $this->offer->id,
            'service_provider_id' => $this->offer->service_provider_id,
        ]);
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
