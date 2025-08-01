<?php

namespace App\Filament\Resources;

use App\Enums\ServiceProviderStatusEnum;
use App\Filament\Resources\ServiceProviderResource\Pages;
use App\Filament\Resources\ServiceProviderResource\Pages\ServiceProviderDetails;
use App\Filament\Resources\ServiceProviderResource\RelationManagers;
use App\Models\City;
use App\Models\ServiceProvider;
use App\Models\State;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceProviderResource extends Resource
{
    protected static ?string $model = ServiceProvider::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('shop_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('thumbnail')
                    ->label('Thumbnail')
                    ->image()
                    ->directory('thumbnails')
                    ->visibility('public')
                    ->imagePreviewHeight('100')
                    ->required(),
                Forms\Components\TextInput::make('views')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('shop_name')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->getStateUsing(fn ($record) => $record->thumbnail ? asset('storage/' . $record->thumbnail) : null)
                    ->height(60)
                    ->circular(),
                Tables\Columns\TextColumn::make('views')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                    Tables\Columns\TagsColumn::make('tags.name')
                    ->label('Tags'),
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
                Tables\Filters\SelectFilter::make('category_id')
                ->label('Category')
                ->relationship('category', 'name'),

            Tables\Filters\SelectFilter::make('subcategory_id')
                ->label('Subcategory')
                ->relationship('subcategory', 'name'),

            Tables\Filters\SelectFilter::make('state_id')
                ->label('State')
                ->options(fn () => State::pluck('name', 'id')->toArray()),

            Tables\Filters\SelectFilter::make('state_id')
                ->label('City')
                ->options(fn () => City::pluck('name', 'id')->toArray()),

            Tables\Filters\MultiSelectFilter::make('tags')
                ->label('Tags')
                ->relationship('tags', 'name'),

            Tables\Filters\SelectFilter::make('status')
            ->options(ServiceProviderStatusEnum::asSelectArray()),
            ])

            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('view')
                    ->label('View')
                    ->icon('heroicon-o-eye')
                    ->url(fn ($record) => ServiceProviderResource::getUrl('details', ['record' => $record]))
                    ->openUrlInNewTab(false),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServiceProviders::route('/'),
            'create' => Pages\CreateServiceProvider::route('/create'),
            'edit' => Pages\EditServiceProvider::route('/{record}/edit'),
            'details' => ServiceProviderDetails::route('/{record}/details'),
        ];
    }
}
