<?php

    namespace App\Filament\Resources\NotificationResource\Pages;

    use App\Filament\Resources\NotificationResource;
    use App\Models\Customer;
    use App\Notifications\AddNotification;
    use Filament\Actions;
    use Filament\Forms\Components\DatePicker;
    use Filament\Forms\Components\Select;
    use Filament\Forms\Components\Textarea;
    use Filament\Forms\Components\TextInput;
    use Filament\Forms\Components\TimePicker;
    use Filament\Resources\Pages\CreateRecord;
    use Filament\Forms\Form;


    class CreateNotification extends CreateRecord
    {
        protected static string $resource = NotificationResource::class;


    protected function mutateFormDataBeforeCreate(array $data): array
{
    $data['auto_notification'] = 1; // always force
    return $data;
}
protected function afterCreate(): void
{
    $notification = $this->record;

    // Notify all customers
    if ($notification->send_to === 'all') {
        $customers = Customer::where('notifications_enabled', true)->get();
        AddNotification::createForRecipients($notification, $customers);
    }

    // Notify specific customer
    if ($notification->send_to === 'specific') {
        $customer = Customer::find($this->data['recipient_id'] ?? null);
        if ($customer) {
            AddNotification::createForRecipients($notification, [$customer]);
        }
    }
}

    }