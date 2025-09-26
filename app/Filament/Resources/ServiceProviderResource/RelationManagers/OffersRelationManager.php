<?php

namespace App\Filament\Resources\ServiceProviderResource\RelationManagers;

use App\Filament\Resources\OfferResource;
use App\Models\Scopes\ActiveScope;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OffersRelationManager extends RelationManager
{
    protected static string $resource = OfferResource::class;
    protected static string $relationship = 'offers';


    public function form(Form $form): Form
    {
        return OfferResource::form($form);
    }

    public function table(Table $table): Table
    {
        return OfferResource::table($table)
        ->headerActions([
            Tables\Actions\CreateAction::make()
            ->using(function (array $data) {
                return $this->getOwnerRecord()->offers()->create($data);
            }),

        ]);
    }
}
