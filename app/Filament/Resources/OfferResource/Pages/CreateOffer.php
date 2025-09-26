<?php

namespace App\Filament\Resources\OfferResource\Pages;

use App\Filament\Resources\OfferResource;
use App\Models\Customer;
use App\Notifications\NewOfferNotification;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOffer extends CreateRecord
{
    protected static string $resource = OfferResource::class;

    protected function afterCreate(): void
{
    $offer = $this->record;
    $state = $offer->serviceProvider->state ?? null;

    if ($state) {
        $customers = Customer::where('state_id', $state->id)
        ->where('notifications_enabled', true)
        ->get();

        NewOfferNotification::createForRecipients($offer, $customers);
    }
}
}
