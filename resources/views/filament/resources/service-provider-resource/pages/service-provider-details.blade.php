<x-filament-panels::page>
    <x-slot name="header">
        <h1 class="text-2xl font-bold tracking-tight">
            Service Provider Details
        </h1>
    </x-slot>

    <div class="space-y-4">
        <x-filament::card>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <p><strong>Name:</strong> {{ $service_provider->name }}</p>
                    <p><strong>Shop Name:</strong> {{ $service_provider->shop_name }}</p>
                    <p><strong>Status:</strong> {{ $service_provider->status }}</p>
                    <p><strong>Description:</strong> {{ $service_provider->description }}</p>
                    <p><strong>Views:</strong> {{ $service_provider->views }}</p>

                    <p><strong>Category:</strong> {{ $service_provider->category->name ?? '-' }}</p>
                    <p><strong>Subcategory:</strong> {{ $service_provider->subCategory->name ?? '-' }}</p>
                    <p><strong>State:</strong> {{ $service_provider->state->name ?? '-' }}</p>
                    <p><strong>City:</strong> {{ $service_provider->city->name ?? '-' }}</p>

                    <p><strong>Phone:</strong> {{ $service_provider->phone_number }}</p>
                    <p><strong>WhatsApp:</strong> {{ $service_provider->whatsapp ?? '-' }}</p>
                    <p><strong>Facebook:</strong> {{ $service_provider->facebook ?? '-' }}</p>
                    <p><strong>Instagram:</strong> {{ $service_provider->instagram ?? '-' }}</p>

                    <p><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($service_provider->start_date)->format('Y-m-d') ?? '-' }}</p>
                    <p><strong>End Date:</strong> {{ \Carbon\Carbon::parse($service_provider->end_date)->format('Y-m-d') ?? '-' }}</p>
                </div>

                <div>
                    @if($service_provider->thumbnail)
                        <img src="{{ asset('storage/' . $service_provider->thumbnail) }}" alt="Thumbnail" class="w-48 rounded-lg shadow">
                    @else
                        <div class="text-gray-500">No Thumbnail</div>
                    @endif
                </div>

                @if (!empty($service_provider->gallery))
                    <div class="mt-6">
                        <h2 class="text-lg font-semibold mb-2">Gallery</h2>
                        <div class="flex flex-wrap gap-4">
                            @foreach ($service_provider->gallery as $image)
                                <img src="{{ asset('storage/' . $image) }}" alt="Gallery Image" class="w-32 h-32 object-cover rounded shadow">
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            @if($service_provider->tags->isNotEmpty())
                <strong>Tags</strong>
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($service_provider->tags as $tag)
                        <li>{{ $tag->name }}</li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">No tags available.</p>
            @endif

            @if($service_provider->offers->isNotEmpty())
                <strong>Offers</strong>
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($service_provider->offers as $offer)
                        <li>{{ $offer->title }}</li>
                        <img src="{{ asset('storage/' . $offer->image) }}" width="150" height="150">
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">No tags available.</p>
            @endif

        </x-filament::card>
    </div>
</x-filament-panels::page>
