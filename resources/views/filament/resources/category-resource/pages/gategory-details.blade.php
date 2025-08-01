<x-filament::page>
    <div class="space-y-6">

        {{-- Category Overview --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
            <div class="flex items-center gap-4">
                <img src="{{ asset('storage/' . $category->thumbnail) }}" alt="{{ $category->name }}" class="w-24 h-24 object-cover rounded-xl border dark:border-gray-600">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $category->name }}</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">{{ $category->description }}</p>
                    <span class="text-xs font-medium px-2 py-1 rounded-full mt-3 inline-block
                        {{ $category->status === 'active'
                            ? 'bg-green-100 text-green-700 dark:bg-green-700 dark:text-green-100'
                            : 'bg-red-100 text-red-700 dark:bg-red-700 dark:text-red-100' }}">
                        {{ ucfirst($category->status->value) }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Related Subcategories --}}
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Subcategories</h3>

            @if($category->subcategories->count())
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($category->subcategories as $sub)
                        <li class="py-3 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <span class="text-sm text-gray-800 dark:text-gray-100 font-medium">{{ $sub->name }}</span>
                            </div>
                            <span class="text-xs font-semibold px-2 py-1 rounded-full
                                {{ $sub->status === 'active'
                                    ? 'bg-green-100 text-green-700 dark:bg-green-700 dark:text-green-100'
                                    : 'bg-red-100 text-red-700 dark:bg-red-700 dark:text-red-100' }}">
                                {{ ucfirst($sub->status->value) }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-sm text-gray-600 dark:text-gray-400">No subcategories found.</p>
            @endif
        </div>

    </div>
</x-filament::page>