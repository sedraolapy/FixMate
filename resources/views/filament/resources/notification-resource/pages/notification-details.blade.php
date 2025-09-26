<x-filament::page>
    <x-filament::card>
        <h2 class="text-xl font-bold mb-4">Notification Details</h2>

        <p><strong>Title:</strong> {{ $record->title }}</p>
        <p><strong>Body:</strong> {{ $record->body }}</p>
        <p><strong>Send To:</strong> {{ $record->send_to }}</p>

        @if($record->recipients && $record->recipients->isNotEmpty())
            <p><strong>User Name{{ $record->recipients->count() > 1 ? 's' : '' }}:</strong>
                {{ $record->recipients->map(fn($r) => $r->recipient->name ?? $r->recipient->email ?? 'N/A')->join(', ') }}
            </p>
        @endif

        <p><strong>Date:</strong> {{ optional($record->created_at)->format('Y-m-d') }}</p>
        <p><strong>Time:</strong> {{ optional($record->created_at)->format('H:i') }}</p>
    </x-filament::card>
</x-filament::page>
