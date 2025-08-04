<x-filament-panels::page>
    <x-slot name="header">
        <h1 class="text-2xl font-bold tracking-tight">
            Offer Details
        </h1>
    </x-slot>

    <div class="space-y-6">
        <x-filament::card>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p><strong>Offer Title:</strong> {{ $offer->title }}</p>

                    <p><strong>Related Service Provider:</strong>
                        {{ $offer->serviceProvider?->name ?? '-' }}
                    </p>

                    <p><strong>Status:</strong> {{ ucfirst($offer->status) }}</p>

                    <p><strong>Start Date:</strong> {{ \Illuminate\Support\Carbon::parse($offer->start_date)->format('Y-m-d') }}</p>

                    <p><strong>Expire Date:</strong> {{ \Illuminate\Support\Carbon::parse($offer->expire_date)->format('Y-m-d') }}</p>

                </div>

                <div>
                    @if($offer->image)
                        <img src="{{ asset('storage/' . $offer->image) }}"
                             alt="Offer Image"
                             class="w-64 rounded-lg shadow" />
                    @else
                        <div class="text-gray-500 italic">No Offer Image</div>
                    @endif
                </div>
            </div>
        </x-filament::card>
    </div>
</x-filament-panels::page>
