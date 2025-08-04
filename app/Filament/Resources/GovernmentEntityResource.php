<?php

namespace App\Filament\Resources;

use App\Enums\GovernmentEntityStatusEnum;
use App\Filament\Resources\GovernmentEntityResource\Pages;
use App\Filament\Resources\GovernmentEntityResource\Pages\GovernmentEntityDetails;
use App\Filament\Resources\GovernmentEntityResource\RelationManagers;
use App\Models\GovernmentEntity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GovernmentEntityResource extends Resource
{
    protected static ?string $model = GovernmentEntity::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\FileUpload::make('image')
                    ->label('image')
                    ->image()
                    ->directory('images')
                    ->visibility('public')
                    ->imagePreviewHeight('100'),

                Forms\Components\Repeater::make('phone_numbers')
                    ->label('Phone Numbers')
                    ->schema([
                        Forms\Components\TextInput::make('number')
                            ->label('Phone Number')
                            ->tel()
                            ->required()
                            ->maxLength(10)
                            ->placeholder('Enter phone number'),
                    ])
                    ->minItems(1)
                    ->columns(1)
                    ->required()
                    ->default([['number' => '']])
                    ->collapsible()
                    ->createItemButtonLabel('Add Phone Number'),

                Forms\Components\TextInput::make('facebook')
                    ->url()
                    ->nullable(),
                Forms\Components\TextInput::make('instagram')
                    ->url()
                    ->nullable(),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->default(GovernmentEntityStatusEnum::ACTIVE),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),

                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->getStateUsing(fn ($record) =>
                        $record->image
                            ? asset('storage/' . $record->image)
                            : asset('storage/images/default.png')
                    )
                    ->height(60)
                    ->circular(),

                    Tables\Columns\TextColumn::make('phone_numbers')
                    ->label('Phone Numbers'),

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
                    ->options(GovernmentEntityStatusEnum::asSelectArray()),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('view')
                    ->label('View')
                    ->icon('heroicon-o-eye')
                    ->url(fn ($record) => GovernmentEntityResource::getUrl('details', ['record' => $record]))
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
            'index' => Pages\ListGovernmentEntities::route('/'),
            'create' => Pages\CreateGovernmentEntity::route('/create'),
            'edit' => Pages\EditGovernmentEntity::route('/{record}/edit'),
            'details' => GovernmentEntityDetails::route('/{record}/details'),
        ];
    }
}
