<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceProviderRequestResource\Pages;
use App\Filament\Resources\ServiceProviderRequestResource\RelationManagers;
use App\Models\Scopes\ActiveScope;
use App\Models\ServiceProvider;
use App\Models\ServiceProviderRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceProviderRequestResource extends Resource
{
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScope(ActiveScope::class);
    }


    protected static ?string $model = ServiceProviderRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Service Provider Requests';

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
                Forms\Components\TextInput::make('category_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('sub_category_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('thumbnail')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('state_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('city_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('phone_number')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('whatsapp')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('status')
                    ->required(),
                Forms\Components\Textarea::make('notes')
                    ->columnSpanFull(),
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
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable()
                    ->getStateUsing(fn ($record) => optional($record->category()->withoutGlobalScope(ActiveScope::class)->first())->name),

                Tables\Columns\TextColumn::make('subcategory.name')
                    ->label('Subcategory')
                    ->sortable()
                    ->getStateUsing(fn ($record) => optional($record->subcategory()->withoutGlobalScope(ActiveScope::class)->first())->name),

                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->getStateUsing(fn ($record) => $record->thumbnail ? asset('storage/' . $record->thumbnail) : null)
                    ->height(60)
                    ->circular(),
                Tables\Columns\TextColumn::make('description')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('state.name')
                    ->label('State')
                    ->sortable()
                    ->getStateUsing(fn ($record) => optional($record->state()->withoutGlobalScope(ActiveScope::class)->first())->name),

                Tables\Columns\TextColumn::make('city.name')
                    ->label('City')
                    ->sortable()
                    ->getStateUsing(fn ($record) => optional($record->city()->withoutGlobalScope(ActiveScope::class)->first())->name),

                Tables\Columns\TextColumn::make('phone_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('whatsapp'),
                Tables\Columns\TextColumn::make('facebook'),
                Tables\Columns\TextColumn::make('instagram'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('deleted_at')->dateTime(),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ]),

            ])

            ->actions([

                Tables\Actions\Action::make('approve')
                ->label('Approve')
                ->action(function ($record) {
                    ServiceProvider::create([
                        'name'             => $record->name,
                        'shop_name'        => $record->shop_name,
                        'category_id'      => $record->category_id,
                        'sub_category_id'  => $record->sub_category_id,
                        'thumbnail'        => $record->thumbnail,
                        'description'      => $record->description,
                        'state_id'         => $record->state_id,
                        'city_id'          => $record->city_id,
                        'phone_number'     => $record->phone_number,
                        'whatsapp'         => $record->whatsapp,
                        'facebook'         => $record->facebook,
                        'instagram'        => $record->instagram,
                        'status'           => 'active',
                    ]);
                    $record->update([
                        'status' => 'approved',
                    ]);
                })
                ->icon('heroicon-o-check')
                ->color('success'),

            Tables\Actions\Action::make('reject')
                ->label('Reject')
                ->requiresConfirmation()
                ->action(function ($record) {
                    $record->update(['status' => 'rejected']);
                })
                ->icon('heroicon-o-x-mark')
                ->color('danger'),
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
            'index' => Pages\ListServiceProviderRequests::route('/'),
            // 'create' => Pages\CreateServiceProviderRequest::route('/create'),
            'edit' => Pages\EditServiceProviderRequest::route('/{record}/edit'),
        ];
    }
}
