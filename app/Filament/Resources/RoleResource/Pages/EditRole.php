<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class EditRole extends EditRecord
{
    protected static string $resource = RoleResource::class;
    protected function afterSave(): void
    {
        $state = $this->form->getRawState();
        $permissions = $state['permissions_list'] ?? [];
        $syncData = [];

        foreach ($permissions as $perm) {
            $permission = Permission::where('name', $perm['title'])->first();
            if ($permission) {
                $syncData[$permission->id] = [
                    'status' => $perm['status'] ? 1 : 0,
                ];
            }
        }

        $this->record->permissions()->sync($syncData);
    }

}
