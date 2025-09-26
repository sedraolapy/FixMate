<?php
namespace App\Filament\Resources;

use App\Enums\PermissionEnum;
use Filament\Forms;
use Filament\Tables;
use App\Filament\Resources\CustomRoleResource\Pages;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use App\Models\Role;
use App\Models\Scopes\ActiveScope;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Builder;

use function Laravel\Prompts\select;

class CustomRoleResource extends Resource
{
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScope(ActiveScope::class);
    }


    protected static ?string $model = Role::class;
    protected static ?string $navigationIcon = 'heroicon-o-key';


    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label('Role Title')
                ->required(),

            Select::make('guard_name')
                ->label('Guard')
                ->options([
                    'customer' => 'customer',
                    'service_provider' => 'service_provider',
                    'admin' => 'admin',
                ])
                ->default('web')
                ->required(),

            // Permissions list with status toggle
            Repeater::make('permissions')
                ->label('Permissions')
                ->schema([
                    Select::make('name')
                        ->label('Permission Title')
                        ->options(
                            collect(PermissionEnum::cases())
                                ->mapWithKeys(fn ($case) => [$case->value => ucfirst($case->value)])
                                ->toArray()
                        )
                        ->required(),

                    Toggle::make('status')
                        ->label('Status')
                        ->default(false)
                        ->onIcon('heroicon-o-check')
                        ->offIcon('heroicon-o-x-mark'),
                ])
                ->columns(2)
                ->required()
                ->minItems(1)
                ->dehydrated(false)

                // ✅ Prefill existing role permissions + pivot "status"
                ->afterStateHydrated(function ($set, $state, $record) {
                    if (!$record) {
                        return;
                    }

                    $permissions = $record->permissions->map(function ($perm) {
                        return [
                            'name' => $perm->name,
                            'status' => (bool) $perm->pivot->status,
                        ];
                    })->toArray();

                    $set('permissions', $permissions);
                })

                ->rule(function ($get, $state) {
                    if (!collect($state)->contains(fn($p) => $p['status'] ?? false)) {
                        return 'You must turn at least one permission On.';
                    }
                    return null;
                })

                ->saveRelationshipsUsing(function ($record, $state) {
                    $syncData = [];
                    foreach ($state as $permission) {
                        $perm = Permission::firstOrCreate(['name' => $permission['name']]);
                        $syncData[$perm->id] = [
                            'status' => $permission['status'] ? 1 : 0,
                        ];
                    }

                    $record->permissions()->sync($syncData);
                }),
        ]);
    }


    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')
                ->label('Role Title')
                ->searchable(),
            TextColumn::make('users_count')
            ->label('Number of Users')
            ->getStateUsing(function ($record) {
                $customerCount = $record->customers()->count();
                $providerCount = $record->serviceProviders()->count();
                $adminCount = $record->admins()->count();
                return $customerCount + $providerCount + $adminCount ;
            })
            ->sortable(),
            Tables\Columns\TextColumn::make('status')

        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\Action::make('view')
                ->label('View')
                ->icon('heroicon-o-eye')
                ->url(fn ($record) => CustomRoleResource::getUrl('details', ['record' => $record]))
                ->openUrlInNewTab(false),
        ])
        ->bulkActions([Tables\Actions\DeleteBulkAction::make()])
        ->filters([
            Tables\Filters\SelectFilter::make('status')
            ->label('Status')
            ->options([
                'Active' => 'active',
                'Inactive' => 'inactive',
            ]),
        ]);
    }

    public static function getPages(): array
{
    return [
        'index' => Pages\ListCustomRoles::route('/'),
        'create' => Pages\CreateCustomRole::route('/create'),
        'edit' => Pages\EditCustomRole::route('/{record}/edit'),
        'details' => Pages\RoleDetails::route('/{record}/details'),
    ];
}

}
