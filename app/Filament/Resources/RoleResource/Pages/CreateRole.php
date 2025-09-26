<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use Filament\Resources\Pages\CreateRecord;
use Spatie\Permission\Models\Permission;

class CreateRole extends CreateRecord
{
    protected static string $resource = RoleResource::class;

    protected function afterCreate(): void
    {
        $state = $this->form->getRawState(); // ✅ get non-dehydrated fields
        $permissions = $state['permissions_list'] ?? [];
        $syncData = [];

        foreach ($permissions as $perm) {
            $permission = Permission::where('name', $perm['title'])->first();
            if ($permission) {
                $syncData[$permission->id] = [
                    'status' => $perm['status'] ? 1 : 0
                ];
            }
        }

        $this->record->permissions()->sync($syncData); // ✅ store in role_has_permissions
    }
}
