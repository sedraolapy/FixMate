<?php

namespace App\Filament\Resources;

use App\Enums\CustomerStatusEnum;
use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\Pages\CustomerDetails;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\City;
use App\Models\Customer;
use App\Models\Scopes\ActiveScope;
use App\Models\State;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

class CustomerResource extends Resource
{
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScope(ActiveScope::class);
    }


    protected static ?string $model = Customer::class;
    protected static ?string $navigationIcon = 'heroicon-o-user';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('last_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone_number')
                    ->tel()
                    ->required()
                    ->disabledOn('edit')
                    ->maxLength(10),
                Forms\Components\FileUpload::make('image')
                    ->label('image')
                    ->image()
                    ->directory('images')
                    ->visibility('public')
                    ->required()
                    ->imagePreviewHeight('100'),
                Forms\Components\Section::make('Location')
                    ->schema([
                        Forms\Components\Select::make('state_id')
                            ->label('State')
                            ->relationship('state', 'name')
                            ->required()
                            ->preload(),

                        Forms\Components\Select::make('city_id')
                            ->label('City')
                            ->options(function (callable $get) {
                                $stateId = $get('state_id');
                                return City::where('state_id', $stateId)
                                    ->pluck('name', 'id');
                            })
                            ->required()
                            ->searchable()
                            ->preload(),
                    ])
                    ->columns(2),
                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options(CustomerStatusEnum::asSelectArray())
                    ->default(CustomerStatusEnum::ACTIVE->value)
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn ($state) => $state?->translate())
                    ->badge()
                    ->color(fn ($state) => match ($state) {
                        CustomerStatusEnum::ACTIVE => 'success',
                        CustomerStatusEnum::INACTIVE => 'gray',
                        CustomerStatusEnum::SUSPENDED => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('state_id')
                    ->label('State')
                    ->options(fn () => State::pluck('name', 'id')->toArray()),

                Tables\Filters\SelectFilter::make('city_id')
                    ->label('City')
                    ->options(fn () => City::pluck('name', 'id')->toArray()),

                Tables\Filters\SelectFilter::make('status')
                ->options(CustomerStatusEnum::asSelectArray()),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),

                Tables\Actions\Action::make('view')
                    ->label('View')
                    ->icon('heroicon-o-eye')
                    ->url(fn ($record) => CustomerResource::getUrl('details', ['record' => $record]))
                    ->openUrlInNewTab(false),

                Tables\Actions\Action::make('toggleStatus')
                    ->label(fn (Customer $record) =>
                        $record->status === CustomerStatusEnum::SUSPENDED ? 'Restore' : 'Suspend'
                    )
                    ->icon(fn (Customer $record) =>
                        $record->status === CustomerStatusEnum::SUSPENDED
                            ? 'heroicon-o-arrow-path'
                            : 'heroicon-o-pause'
                    )
                    ->action(function (Customer $record) {
                        $newStatus = $record->status === CustomerStatusEnum::SUSPENDED
                            ? CustomerStatusEnum::ACTIVE
                            : CustomerStatusEnum::SUSPENDED;

                        $record->update(['status' => $newStatus]);
                        // If user is suspended, terminate all sessions
                        if ($newStatus === CustomerStatusEnum::SUSPENDED) {
                            $sessions = DB::table('sessions')->get();
                            foreach ($sessions as $session) {
                                $data = unserialize(base64_decode($session->payload));
                                if (isset($data['customer_id']) && $data['customer_id'] == $record->id) {
                                    DB::table('sessions')->where('id', $session->id)->delete();
                                }
                            }
                        }
                    }),

                Tables\Actions\Action::make('changeStatus')
                    ->form([
                        Forms\Components\Select::make('status')
                            ->label('Change Status')
                            ->options(CustomerStatusEnum::asSelectArray())
                            ->required(),
                    ])
                    ->action(function (array $data, Customer $record) {
                        $record->update([
                            'status' => $data['status'],
                        ]);
                    })
                    ->label('Change Status')
                    ->icon('heroicon-o-adjustments-horizontal'),
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
            'details' => CustomerDetails::route('/{record}/details'),
        ];
    }
}
