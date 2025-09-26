<?php

namespace App\Filament\Resources;

use App\Enums\GovernmentEntityStatusEnum;
use App\Filament\Resources\GovernmentEntityResource\Pages;
use App\Filament\Resources\GovernmentEntityResource\Pages\GovernmentEntityDetails;
use App\Filament\Resources\GovernmentEntityResource\RelationManagers;
use App\Models\GovernmentEntity;
use App\Models\Scopes\ActiveScope;
use Filament\Forms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GovernmentEntityResource extends Resource
{
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScope(ActiveScope::class);
    }

    protected static ?string $model = GovernmentEntity::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';


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

                Forms\Components\FileUpload::make('image')
                    ->label('image')
                    ->image()
                    ->directory('images')
                    ->visibility('public')
                    ->imagePreviewHeight('100'),

                Repeater::make('phone_numbers')
                    ->label('Phone Numbers')
                    ->schema([
                        TextInput::make('number')
                            ->label('Phone Number')
                            ->required(),
                    ])
                    ->addActionLabel('Add another number')
                    ->columns(1)
                    ->reorderable(),


                Forms\Components\TextInput::make('facebook')
                    ->url()
                    ->nullable(),
                Forms\Components\TextInput::make('instagram')
                    ->url()
                    ->nullable(),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options(GovernmentEntityStatusEnum::asSelectArray())
                    ->default(GovernmentEntityStatusEnum::ACTIVE->value)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->formatStateUsing(fn ($state) => is_array($state) ? $state[app()->getLocale()] ?? $state['en'] : $state)
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
                TextColumn::make('phone_numbers')
                    ->label('Phone Numbers')
                    ->formatStateUsing(fn ($state) => is_string($state) ? $state : json_encode($state)),

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
