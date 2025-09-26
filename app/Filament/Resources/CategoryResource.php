<?php

namespace App\Filament\Resources;

use App\Enums\CategorystatusEnum;
use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\Pages\CategoryDetails;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use App\Models\Scopes\ActiveScope;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class CategoryResource extends Resource
{
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScope(ActiveScope::class);
    }

    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';


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
                Forms\Components\FileUpload::make('thumbnail')
                    ->label('Thumbnail')
                    ->image()
                    ->directory('thumbnails')
                    ->visibility('public')
                    ->imagePreviewHeight('100')
                    ->required(),
                Forms\Components\Group::make([
                        Forms\Components\TextInput::make('description.en')
                            ->label('Description (English)')
                            ->required(),

                        Forms\Components\TextInput::make('description.ar')
                            ->label('Description (Arabic)')
                            ->required(),
                    ])
                    ->columns(2),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255)
                    ->default('active'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->getStateUsing(fn ($record) => asset('storage/' . $record->thumbnail))
                    ->height(60)
                    ->circular(),

                Tables\Columns\TextColumn::make('description'),

                Tables\Columns\TextColumn::make('status')
                ->label('Status'),

                Tables\Columns\TextColumn::make('subcategories_count')
                    ->label('Total Subcategories')
                    ->counts([
                        'subcategories' => fn ($query) => $query->withoutGlobalScopes([
                            ActiveScope::class,
                        ]),
                    ]),

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
                    ->options(CategorystatusEnum::asSelectArray()),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('view')
                    ->label('View')
                    ->icon('heroicon-o-eye')
                    ->url(fn ($record) => CategoryDetails::getUrl(['record' => $record]))
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
            'details' => Pages\CategoryDetails::route('/{record}/details'),
        ];
    }
}
