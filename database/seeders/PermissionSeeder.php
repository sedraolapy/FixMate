<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (PermissionEnum::cases() as $permission) {
            $name = $permission->value;
            $guards = $permission->guard();

            foreach ($guards as $guard) {
                Permission::updateOrCreate(
                    [
                        'name' => $name,
                        'guard_name' => $guard,
                    ],
                    [
                        'name' => $name,
                        'guard_name' => $guard,
                    ]
                );
            }
        }
    }

}
