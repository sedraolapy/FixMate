<?php

namespace App\Filament\Resources\GovernmentEntityResource\Pages;

use App\Filament\Resources\GovernmentEntityResource;
use App\Models\GovernmentEntity;
use Filament\Resources\Pages\Page;

class GovernmentEntityDetails extends Page
{

    public ?GovernmentEntity $governmentEntity = null;

    public function mount($record): void
    {
        $this->governmentEntity = GovernmentEntity::findOrFail($record);
    }

    public static function getRoute(): string
    {
        return '/{record}/details';
    }

    protected static string $resource = GovernmentEntityResource::class;

    protected static string $view = 'filament.resources.government-entity-resource.pages.government-entity-details';
}
