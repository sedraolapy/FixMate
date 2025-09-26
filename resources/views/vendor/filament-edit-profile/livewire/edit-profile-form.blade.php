<x-filament-panels::form wire:submit="updateProfile">
    {{ $this->form }}

    <div class="fi-form-actions">
        <div class="flex flex-row-reverse flex-wrap items-center gap-3 fi-ac">
            <x-filament::button
                wire:click="updateProfile"
                :disabled="!$hasChanges"
            >
                {{ __('filament-edit-profile::default.save') }}
            </x-filament::button>
            @if (!$hasChanges)
                <p class="text-sm text-gray-500 mt-2">
                    Make a change to enable saving.
                </p>
            @endif
        </div>
    </div>
</x-filament-panels::form>
