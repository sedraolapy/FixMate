<?php

namespace App\Filament\Resources;

use App\Enums\ServiceProviderStatusEnum;
use App\Filament\Resources\ServiceProviderResource\Pages;
use App\Filament\Resources\ServiceProviderResource\Pages\ServiceProviderDetails;
use App\Filament\Resources\ServiceProviderResource\RelationManagers;
use App\Filament\Resources\ServiceProviderResource\RelationManagers\OffersRelationManager;
use App\Models\City;
use App\Models\Scopes\ActiveScope;
use App\Models\ServiceProvider;
use App\Models\State;
use App\Models\Tag;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;



class ServiceProviderResource extends Resource
{
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScope(ActiveScope::class);
    }

    protected static ?string $model = ServiceProvider::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';


    public static function form(Form $form): Form
    {
        return $form->schema([

            Forms\Components\Section::make('Basic Information')
                ->description('Enter the service provider’s basic details.')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Provider Name')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\TextInput::make('shop_name')
                        ->label('Shop Name')
                        ->required()
                        ->maxLength(255),

                    Forms\Components\Textarea::make('description')
                        ->label('Description')
                        ->required()
                        ->maxLength(1000)
                        ->autosize(),

                    Forms\Components\FileUpload::make('thumbnail')
                        ->label('Thumbnail')
                        ->image()
                        ->directory('thumbnails')
                        ->visibility('public')
                        ->imagePreviewHeight('120'),

                    Forms\Components\FileUpload::make('gallery')
                        ->label('Gallery')
                        ->multiple()
                        ->image()
                        ->directory('galleries')
                        ->visibility('public')
                        ->imagePreviewHeight('100')
                        ->columnSpanFull(),


                ])
                ->columns(2),

            Forms\Components\Section::make('Category Details')
                ->description('Assign a category and subcategory.')
                ->schema([
                    Forms\Components\Select::make('category_id')
                        ->label('Category')
                        ->relationship('category', 'name')
                        ->required()
                        ->preload(),

                    Forms\Components\Select::make('sub_category_id')
                        ->label('Subcategory')
                        ->options(function (callable $get) {
                            $categoryId = $get('category_id');
                            return \App\Models\SubCategory::where('category_id', $categoryId)
                                ->where('status', 'active')
                                ->pluck('name', 'id');
                        })
                        ->required()
                        ->searchable()
                        ->preload(),

                    Forms\Components\Select::make('tags')
                        ->label('Tags')
                        ->multiple()
                        ->relationship('tags', 'name' ,fn ($query) => $query->where('status','active'))
                        ->required()
                        ->preload(),
                ])
                ->columns(2),

            Forms\Components\Section::make('Location')
                ->schema([
                    Forms\Components\Select::make('state_id')
                        ->label('State')
                        ->relationship('state', 'name' ,fn ($query) => $query->where('status','active'))
                        ->required()
                        ->preload(),

                    Forms\Components\Select::make('city_id')
                        ->label('City')
                        ->options(function (callable $get) {
                            $stateId = $get('state_id');
                            return \App\Models\City::where('state_id', $stateId)
                                ->where('status', 'active')
                                ->pluck('name', 'id');
                        })
                        ->required()
                        ->searchable()
                        ->preload(),
                ])
                ->columns(2),

            Forms\Components\Section::make('Contact Information')
                ->schema([
                    Forms\Components\TextInput::make('phone_number')
                        ->label('Phone Number')
                        ->required()
                        ->tel()
                        ->maxLength(10),

                    Forms\Components\TextInput::make('whatsapp')
                        ->label('WhatsApp Number')
                        ->tel()
                        ->maxLength(10),

                    Forms\Components\TextInput::make('facebook')
                        ->label('Facebook Page')
                        ->url()
                        ->nullable(),

                    Forms\Components\TextInput::make('instagram')
                        ->label('Instagram Page')
                        ->url()
                        ->nullable(),
                ])
                ->columns(2),

            Forms\Components\Section::make('Activity Period')
                ->description('Specify availability period and status.')
                ->schema([
                    Forms\Components\DatePicker::make('start_date')
                        ->label('Start Date')
                        ->default(now()->toDateString())
                        ->beforeOrEqual(now())
                        ->required(),

                    Forms\Components\DatePicker::make('end_date')
                        ->label('End Date')
                        ->after(fn (callable $get) => $get('start_date') ?: now())
                        ->required(),
                    Forms\Components\Select::make('status')
                        ->label('Status')
                        ->options(ServiceProviderStatusEnum::asSelectArray())
                        ->default(ServiceProviderStatusEnum::ACTIVE->value)
                        ->required(),
                ])
                ->columns(3),

            Forms\Components\TextInput::make('views')
                ->numeric()
                ->default(0)
                ->hidden(),

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

            Tables\Filters\SelectFilter::make('city_id')
                ->label('City')
                ->options(fn () => City::pluck('name', 'id')->toArray()),

            Tables\Filters\MultiSelectFilter::make('tags')
                ->label('Tags')
                ->options(fn () => Tag::withoutGlobalScope(ActiveScope::class)->pluck('name', 'id'))
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
            OffersRelationManager::class,
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
