<?php

namespace App\Filament\Resources;

use App\Enums\ServiceProviderStatusEnum;
use App\Filament\Resources\SliderResource\Pages;
use App\Filament\Resources\SliderResource\Pages\SliderDetails;
use App\Filament\Resources\SliderResource\RelationManagers;
use App\Models\Scopes\ActiveScope;
use App\Models\ServiceProvider;
use App\Models\Slider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SliderResource extends Resource
{
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScope(ActiveScope::class);
    }

    protected static ?string $model = Slider::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('image')
                    ->label('image')
                    ->image()
                    ->required()
                    ->directory('image')
                    ->visibility('public')
                    ->imagePreviewHeight('120'),
                Forms\Components\Select::make('service_provider_id')
                    ->label('Related Service Provider')
                    ->relationship('serviceProvider', 'name',fn ($query) => $query->where('status',ServiceProviderStatusEnum::ACTIVE->value))
                    ->searchable()
                    ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                    ->label('image')
                    ->getStateUsing(fn ($record) => $record->image ? asset('storage/' . $record->image) : null)
                    ->height(60)
                    ->circular(),
                Tables\Columns\TextColumn::make('serviceProvider.name')
                    ->label('Service Provider')
                    ->sortable()
                    ->getStateUsing(fn ($record) => optional(
                        $record->serviceProvider()->withoutGlobalScope(ActiveScope::class)->first()
                    )->name ?? 'No Service Provider'),

                Tables\Columns\TextColumn::make('status'),
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
                Tables\Filters\SelectFilter::make('service_provider_id')
                ->label('Service Provider')
                ->relationship('serviceProvider', 'name', fn ($query) => $query->withoutGlobalScope(ActiveScope::class))
                ->searchable(),

                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('view')
                    ->label('View')
                    ->icon('heroicon-o-eye')
                    ->url(fn ($record) => SliderResource::getUrl('details', ['record' => $record]))
                    ->openUrlInNewTab(false),
                Tables\Actions\Action::make('changeStatus')
                    ->label('Change Status')
                    ->icon('heroicon-o-arrow-path')
                    ->action(function (Slider $record) {
                        $record->status = $record->status === 'active' ? 'inactive' : 'active';
                        $record->save();
                    })
                    ->requiresConfirmation()
                    ->color('warning'),


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
            'index' => Pages\ListSliders::route('/'),
            'create' => Pages\CreateSlider::route('/create'),
            'edit' => Pages\EditSlider::route('/{record}/edit'),
            'details' => SliderDetails::route('/{record}/details'),
        ];
    }
}
