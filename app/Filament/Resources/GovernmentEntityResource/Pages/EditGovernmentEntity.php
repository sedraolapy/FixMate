<?php

namespace App\Filament\Resources\GovernmentEntityResource\Pages;

use App\Filament\Resources\GovernmentEntityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGovernmentEntity extends EditRecord
{
    protected static string $resource = GovernmentEntityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
