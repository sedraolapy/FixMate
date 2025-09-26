<x-filament-panels::page>
    <x-slot name="header">
        <h2 class="text-xl font-bold tracking-tight">
            Role Details: {{ $role->name }}
        </h2>
    </x-slot>

    <x-filament::button
    tag="a"
    href="{{ \App\Filament\Resources\CustomRoleResource::getUrl('edit', ['record' => $role]) }}"
    icon="heroicon-o-pencil"
    color="primary"
>
    Edit Role
</x-filament::button>


    <div class="space-y-6">
        {{-- Role Title --}}
        <div class="p-4 bg-white shadow rounded-lg">
            <h3 class="text-lg font-semibold">Role Title</h3>
            <p class="text-gray-700">{{ $role->name }}</p>
        </div>

        {{-- Permissions List --}}
        <div class="p-4 bg-white shadow rounded-lg">
            <h3 class="text-lg font-semibold">Permissions</h3>

            <ul class="divide-y divide-gray-200">
                @foreach ($role->permissions as $permission)
                    <li class="py-3 flex items-center justify-between">
                        <span class="text-gray-800">{{ $permission->name }}</span>

                        {{-- Status toggle (read-only) --}}
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                            {{ $permission->pivot->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $permission->pivot->status ? 'On' : 'Off' }}
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-filament-panels::page>