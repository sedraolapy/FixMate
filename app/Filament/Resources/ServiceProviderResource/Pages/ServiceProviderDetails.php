<?php

namespace App\Filament\Resources\ServiceProviderResource\Pages;

use App\Filament\Resources\ServiceProviderResource;
use App\Models\Scopes\ActiveScope;
use App\Models\ServiceProvider;
use Filament\Resources\Pages\Page;

class ServiceProviderDetails extends Page
{
    public ?ServiceProvider $service_provider = null;

    public function mount($record): void
    {
        $this->service_provider = ServiceProvider::withoutGlobalScope(ActiveScope::class)
            ->with([
                'tags' => fn($q) => $q->withoutGlobalScope(ActiveScope::class),
                'category' => fn($q) => $q->withoutGlobalScope(ActiveScope::class),
                'subcategory' => fn($q) => $q->withoutGlobalScope(ActiveScope::class),
                'state' => fn($q) => $q->withoutGlobalScope(ActiveScope::class),
                'city' => fn($q) => $q->withoutGlobalScope(ActiveScope::class),
                'offers' => fn($q) => $q->withoutGlobalScope(ActiveScope::class),
            ])
            ->findOrFail($record);
    }

    public static function getRoute(): string
{
    return '/{record}/details';
}

    protected static string $resource = ServiceProviderResource::class;

    protected static string $view = 'filament.resources.service-provider-resource.pages.service-provider-details';
}
