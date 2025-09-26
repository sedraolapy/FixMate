<x-filament::page>
    <div class="space-y-6">
        {{-- State Overview --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold text-gray-700 dark:text-white mb-2">State Overview</h2>
            <div class="grid grid-cols-2 gap-4 text-sm text-gray-600 dark:text-gray-100">
                <div>
                    <span class="font-medium text-gray-900 dark:text-white">State Name:</span>
                    {{ $state->name }}
                </div>
                <div>
                    <span class="font-medium text-gray-900 dark:text-white">Status:</span>
                    <span class="{{ $state->status === 'active'
                        ? 'text-green-600 dark:text-green-400'
                        : 'text-red-600 dark:text-red-400' }}">
                        {{ $state->status  }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Cities List --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow p-6">
            <h2 class="text-lg font-semibold text-gray-700 dark:text-white mb-4">Cities</h2>

            @if($state->cities->count())
                <ul class="divide-y divide-gray-200 dark:divide-gray-600">
                    @foreach($state->cities as $city)
                        <li class="py-3 flex justify-between items-center">
                            <span class="text-sm text-gray-800 dark:text-gray-100">{{ $city->name ?? '—' }}</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-sm text-gray-500 dark:text-gray-300">No cities found for this state.</p>
            @endif
        </div>
    </div>
</x-filament::page>