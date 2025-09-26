<?php

namespace App\Filament\Resources\ServiceProviderRequestResource\Pages;

use App\Filament\Resources\ServiceProviderRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServiceProviderRequest extends EditRecord
{
    protected static string $resource = ServiceProviderRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
