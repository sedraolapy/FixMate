<?php

namespace App\Filament\Resources;

use App\Enums\OfferStatusEnum;
use App\Enums\ServiceProviderStatusEnum;
use App\Filament\Resources\OfferResource\Pages;
use App\Filament\Resources\OfferResource\Pages\OfferDetails;
use App\Filament\Resources\OfferResource\RelationManagers;
use App\Models\Offer;
use App\Models\Scopes\ActiveScope;
use App\Models\ServiceProvider;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Validation\Rule;

class OfferResource extends Resource
{
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScope(ActiveScope::class);
    }

    protected static ?string $model = Offer::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';



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
                    ->directory('images')
                    ->visibility('public')
                    ->imagePreviewHeight('100')
                    ->required(),
                Forms\Components\Select::make('service_provider_id')
                    ->label('Related Service Provider')
                    ->relationship('serviceProvider', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                Forms\Components\DatePicker::make('start_date')
                    ->required()
                    ->minDate(now())
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('expire_date', null)),

                Forms\Components\DatePicker::make('expire_date')
                    ->label('Expire Date')
                    ->required()
                    ->minDate(fn (callable $get) => $get('start_date') ?? now())
                    ->rule('after_or_equal:start_date'),

                Forms\Components\TextInput::make('status')
                    ->required()
                    ->default(OfferStatusEnum::ACTIVE),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image')
                ->label('images')
                ->getStateUsing(fn ($record) => asset('storage/' . $record->image))
                ->height(60)
                ->circular(),
                Tables\Columns\TextColumn::make('serviceProvider.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('expire_date')
                    ->date()
                    ->sortable(),
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
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options(OfferStatusEnum::asSelectArray()),

                Tables\Filters\SelectFilter::make('service_provider_id')
                    ->label('service provider name')
                    ->relationship('serviceProvider', 'name')
                    ->options(fn () => ServiceProvider::pluck('name', 'id')->toArray()),

                Tables\Filters\Filter::make('active_on')
                    ->label('Active On')
                    ->form([
                        Forms\Components\DatePicker::make('date')->label('Date'),
                    ])
                    ->query(function ($query, array $data) {
                        if ($data['date']) {
                            return $query
                                ->whereDate('start_date', '<=', $data['date'])
                                ->whereDate('expire_date', '>=', $data['date']);
                        }

                        return $query;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('view')
                    ->label('View')
                    ->icon('heroicon-o-eye')
                    ->url(fn ($record) => OfferResource::getUrl('details', ['record' => $record]))
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
            'index' => Pages\ListOffers::route('/'),
            'create' => Pages\CreateOffer::route('/create'),
            'edit' => Pages\EditOffer::route('/{record}/edit'),
            'details' => OfferDetails::route('/{record}/details'),
        ];
    }
}
