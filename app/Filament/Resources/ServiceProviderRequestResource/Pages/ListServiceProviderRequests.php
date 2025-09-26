<?php

namespace App\Filament\Resources\ServiceProviderRequestResource\Pages;

use App\Filament\Resources\ServiceProviderRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServiceProviderRequests extends ListRecords
{
    protected static string $resource = ServiceProviderRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
