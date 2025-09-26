<?php

namespace App\Filament\Resources;

use App\Enums\CityStatusEnum;
use App\Filament\Resources\CityResource\Pages;
use App\Filament\Resources\CityResource\RelationManagers;
use App\Filament\Resources\CityResource\RelationManagers\StateRelationManager;
use App\Models\City;
use App\Models\Scopes\ActiveScope;
use App\Models\State;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CityResource extends Resource
{
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScope(ActiveScope::class);
    }

    protected static ?string $model = City::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make([
                    Forms\Components\TextInput::make('name.en')
                        ->label('Name (English)')
                        ->required(),

                    Forms\Components\TextInput::make('name.ar')
                        ->label('Name (Arabic)')
                        ->required(),
                ])
                ->columns(2),
                Forms\Components\Select::make('state_id')
                    ->label('Related State')
                    ->relationship('state', 'name')
                    ->options(State::pluck('name', 'id'))
                    ->required()
                    ->searchable(),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options(CityStatusEnum::asSelectArray())
                    ->default(CityStatusEnum::ACTIVE->value)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                    Tables\Columns\TextColumn::make('state.name')
                    ->label('State')
                    ->sortable()
                    ->toggleable()
                    ->getStateUsing(fn ($record) => \App\Models\State::withoutGlobalScopes()
                        ->find($record->state_id)?->name),
                    Tables\Columns\TextColumn::make('status')
                        ->label('Status'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('state_id')
                ->label('State')
                ->options(fn () => \App\Models\State::withoutGlobalScopes()->pluck('name', 'id')->toArray()),


                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options(CityStatusEnum::asSelectArray()),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // StateRelationManager::class,
        ];

    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCities::route('/'),
            'create' => Pages\CreateCity::route('/create'),
            'edit' => Pages\EditCity::route('/{record}/edit'),
        ];
    }
}
