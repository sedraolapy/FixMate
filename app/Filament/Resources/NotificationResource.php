<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NotificationResource\Pages;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Notification;
use App\Models\ServiceProvider;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;

class NotificationResource extends Resource
{
    protected static ?string $model = Notification::class;

    protected static ?string $navigationIcon = 'heroicon-o-bell';


    // Aggregated query for table
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('auto_notification', 1)
            ->withCount('recipients');
    }

    public static function form(Forms\Form $form): Forms\Form
{
    return $form
        ->schema([
            TextInput::make('title')
                ->label('Title')
                ->required()
                ->maxLength(255),

            Textarea::make('body')
                ->label('Body')
                ->required()
                ->rows(3),

            Select::make('send_to')
                ->label('Send To')
                ->options([
                    'all' => 'All',
                    'specific' => 'Specific User',
                ])
                ->reactive()
                ->required(),

            Select::make('recipient_id')
                ->label('Select Customer')
                ->options(Customer::pluck('first_name', 'id'))
                ->searchable()
                ->visible(fn (callable $get) => $get('send_to') === 'specific'),

            DatePicker::make('date')
                ->label('Date')
                ->default(Carbon::today())
                ->required()
                ->rules(['after_or_equal:today']),

            TimePicker::make('time')
                ->label('Time')
                ->default(Carbon::now()->format('H:i'))
                ->required()
                ->rules(['after_or_equal:' . Carbon::now()->format('H:i')]),
        ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable(),

                Tables\Columns\TextColumn::make('recipients_count')
                    ->label('Sent To Members')
                    ->sortable(),

                Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->getStateUsing(fn($record) => optional($record->created_at)->format('Y-m-d'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('time')
                    ->label('Time')
                    ->getStateUsing(fn($record) => optional($record->created_at)->format('H:i'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('from')->label('From'),
                        Forms\Components\DatePicker::make('until')->label('Until'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'], fn($q) => $q->whereDate('created_at', '>=', $data['from']))
                            ->when($data['until'], fn($q) => $q->whereDate('created_at', '<=', $data['until']));
                    })
                    ->label('Filter by Date'),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('View Details')
                    ->icon('heroicon-o-eye')
                    ->url(fn($record) => NotificationResource::getUrl('details', ['record_id' => $record->id]))
                    ->openUrlInNewTab(false),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNotifications::route('/'),
            'create' => Pages\CreateNotification::route('/create'),
            'details' => Pages\NotificationDetails::route('/details/{record_id}'),
        ];
    }
}
