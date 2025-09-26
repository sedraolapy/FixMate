<?php

namespace App\Filament\Resources\NotificationResource\Pages;

use App\Filament\Resources\NotificationResource;
use App\Models\Notification;
use Filament\Resources\Pages\Page;

class NotificationDetails extends Page
{
    protected static string $resource = NotificationResource::class;
    protected static string $view = 'filament.resources.notification-resource.pages.notification-details';

    public Notification $record;

    public function mount($record_id): void
    {
        // Fetch the actual Notification model using ID
        $this->record = Notification::findOrFail($record_id);
    }
}
