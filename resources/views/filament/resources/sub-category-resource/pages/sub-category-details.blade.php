<x-filament-panels::page>
    <div class="space-y-4">
        <h2 class="text-2xl font-bold">{{ $subCategory->name }}</h2>

        <img src="{{ asset('storage/' . $subCategory->thumbnail) }}" alt="Thumbnail" class="w-32 h-32 rounded-lg">

        <p><strong>Description:</strong> {{ $subCategory->description }}</p>
        <p><strong>Status:</strong> {{ $subCategory->status }}</p>
        <p><strong>Category:</strong> {{ $subCategory->category->name ?? 'N/A' }}</p>
    </div>
</x-filament-panels::page>