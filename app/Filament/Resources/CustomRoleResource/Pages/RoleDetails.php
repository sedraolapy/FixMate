<?php

namespace App\Filament\Resources\CustomRoleResource\Pages;

use App\Filament\Resources\CustomRoleResource;
use App\Models\Role;
use App\Models\Scopes\ActiveScope;
use Filament\Resources\Pages\Page;

class RoleDetails extends Page
{

    public ?Role $role = null;

    public function mount($record): void
    {
        $this->role = Role::withoutGlobalScope(ActiveScope::class)->findOrFail($record);
    }

    public static function getRoute(): string
    {
        return '/{record}/details';
    }

    protected static string $resource = CustomRoleResource::class;

    protected static string $view = 'filament.resources.custom-role-resource.pages.role-details';
}
