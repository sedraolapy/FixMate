<?php

namespace App\Filament\Resources\GovernmentEntityResource\Pages;

use App\Filament\Resources\GovernmentEntityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGovernmentEntities extends ListRecords
{
    protected static string $resource = GovernmentEntityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
