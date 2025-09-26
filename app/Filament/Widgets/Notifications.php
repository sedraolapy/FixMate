<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\NotificationRecipient;

class Notifications extends Widget
{
    protected static ?string $heading = 'Notifications';
    protected static string $view = 'filament.widgets.notifications';

    public $notifications;

    public function mount(): void
    {

        $this->notifications = auth('admin')->user()
            ->notifications()
            ->with('notification')
            ->latest()
            ->take(10)
            ->get();
    }

    public function markAsRead($id)
    {
        $recipient = auth('admin')->user()->notifications()->find($id);

        if ($recipient) {
            $recipient->read_at = now();
            $recipient->save();
        }

        $this->mount();
}
}