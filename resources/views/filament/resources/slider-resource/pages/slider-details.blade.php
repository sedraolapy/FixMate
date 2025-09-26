<x-filament-panels::page>
    <div class="space-y-6">
        <h1 class="text-2xl font-bold">{{ $slider->title }}</h1>

        <div>
            <strong>Service Provider:</strong>
            {{ $slider->serviceProvider?->name ?? 'N/A' }}
        </div>

        <div>
            <strong>Created At:</strong>
            {{ $slider->created_at->format('d M Y') }}
        </div>

        <div>
            <strong>Status :</strong>
            {{ $slider->status }}
        </div>

        <div>
            <img src="{{ asset('storage/' . $slider->image) }}" class="w-64 rounded-lg shadow">
        </div>


    </div>
</x-filament-panels::page>
