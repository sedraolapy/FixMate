<?php

namespace App\Filament\Resources;

use App\Enums\SubCategoryStatusEnum;
use App\Filament\Resources\SubCategoryResource\Pages;
use App\Filament\Resources\SubCategoryResource\Pages\SubCategoryDetails;
use App\Filament\Resources\SubCategoryResource\RelationManagers;
use App\Models\Category;
use App\Models\Scopes\ActiveScope;
use App\Models\SubCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubCategoryResource extends Resource
{
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScope(ActiveScope::class);
    }


    protected static ?string $model = SubCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';


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
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options(SubCategoryStatusEnum::asSelectArray())
                    ->default(SubCategoryStatusEnum::ACTIVE->value)
                    ->required(),
                Forms\Components\Select::make('category_id')
                    ->label('Related category')
                    ->relationship('category', 'name')
                    ->options(Category::pluck('name', 'id'))
                    ->required()
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
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->getStateUsing(fn ($record) => $record->category()
                        ->withoutGlobalScope(ActiveScope::class)
                        ->first()?->name),
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
                    ->options(SubCategoryStatusEnum::asSelectArray()),
                    Tables\Filters\SelectFilter::make('category_id')
                    ->label('Category')
                    ->options(fn () => Category::withoutGlobalScope(ActiveScope::class)->pluck('name', 'id')->toArray()),


            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('view')
                        ->label('View')
                        ->icon('heroicon-o-eye')
                        ->url(fn ($record) => $record ? SubCategoryDetails::getUrl(['record' => $record->getKey()]) : '#')
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
            'index' => Pages\ListSubCategories::route('/'),
            'create' => Pages\CreateSubCategory::route('/create'),
            'edit' => Pages\EditSubCategory::route('/{record}/edit'),
            'details' => Pages\SubCategoryDetails::route('/{record}/details'),
        ];
    }
}
