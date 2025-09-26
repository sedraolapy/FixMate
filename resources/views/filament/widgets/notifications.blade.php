<div class="filament-card p-5 bg-white shadow-xl rounded-xl">
    <h2 class="text-2xl font-bold mb-5 text-purple-700 flex items-center">
        <svg class="w-6 h-6 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
        {{ static::$heading }}
    </h2>

    <ul class="divide-y divide-gray-200">
        @forelse($notifications as $recipient)
            @php
                $notification = $recipient->notification;
                // Assign colors/icons based on type or title
                $type = strtolower($notification->title ?? 'default');
                $bgColor = $recipient->read_at ? 'bg-gray-50' : 'bg-purple-50';
                $hoverColor = 'hover:bg-purple-100';
                $icon = match(true) {
                    str_contains($type, 'offer') => '<svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>',
                    str_contains($type, 'service provider') => '<svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3M16 7V3M3 11h18M5 19h14a2 2 0 002-2v-5H3v5a2 2 0 002 2z"/></svg>',
                    str_contains($type, 'contact') => '<svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m8 4H8m12-8H4m0 0l4-4m0 0l4 4"/></svg>',
                    default => '<svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>'
                };
            @endphp

            <li class="py-3 flex justify-between items-start {{ $bgColor }} rounded-lg p-3 mb-2 transition {{ $hoverColor }}">
                <div class="flex items-start flex-1 pr-3">
                    <div class="mr-3">{!! $icon !!}</div>
                    <div>
                        <div class="font-semibold text-gray-900 text-sm md:text-base">{{ $notification->title ?? 'No Title' }}</div>
                        <div class="text-gray-600 text-xs md:text-sm mt-1">{{ $notification->body ?? 'No Description' }}</div>
                        <div class="text-gray-400 text-2xs md:text-xs mt-1">{{ $notification->created_at->format('Y-m-d H:i') }}</div>
                    </div>
                </div>

                <div class="flex flex-col items-end">
                    @if(!$recipient->read_at)
                        <button wire:click="markAsRead('{{ $recipient->id }}')"
                                class="text-xs md:text-sm px-3 py-1 rounded-full border border-purple-600 text-purple-600 hover:bg-purple-600 hover:text-white transition">
                            Mark as Read
                        </button>
                    @else
                        <span class="text-xs md:text-sm text-gray-400 font-medium">Read</span>
                    @endif
                </div>
            </li>
        @empty
            <li class="py-3 text-center text-gray-500">No notifications found.</li>
        @endforelse
    </ul>
</div>
