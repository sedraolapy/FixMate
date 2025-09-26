<?php

namespace App\Filament\Resources\OfferResource\Pages;

use App\Filament\Resources\OfferResource;
use App\Models\Offer;
use App\Models\Scopes\ActiveScope;
use Filament\Resources\Pages\Page;

class OfferDetails extends Page
{
    public ?Offer $offer = null;

    public function mount($record): void
    {
        $this->offer = Offer::withoutGlobalScope(ActiveScope::class)->with('ServiceProvider')->findOrFail($record);
    }

    public static function getRoute(): string
{
    return '/{record}/details';
}

    protected static string $resource = OfferResource::class;

    protected static string $view = 'filament.resources.offer-resource.pages.offer-details';
}
