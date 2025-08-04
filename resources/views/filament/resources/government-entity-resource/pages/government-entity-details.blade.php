<x-filament-panels::page>
    <div class="space-y-6">
        <div class="bg-white p-6 rounded shadow dark:bg-gray-800">
            <div class="flex items-center space-x-4 mb-6">
                {{-- Icon / Image --}}
                @if ($governmentEntity->image)
                    <img src="{{ asset('storage/' . $governmentEntity->image) }}" alt="Entity Image"
                        class="w-20 h-20 rounded-full object-cover border">
                @else

                    <img src="{{ asset('storage/images/default.png') }}" alt="Entity Image">

                @endif

                {{-- Entity Name --}}
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                    {{ $governmentEntity->name }}
                </h2>
            </div>

            {{-- Contact Info --}}
            <div class="space-y-2">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Contacts Info:</h3>

                @if (!empty($governmentEntity->phone_numbers))
                    <ul class="list-disc ml-5 text-sm text-gray-800">
                        @foreach ($governmentEntity->phone_numbers as $phone)
                            <li>{{ $phone['number'] }}</li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-sm text-gray-500">No phone numbers provided.</p>
                @endif

                <div>
                    <strong>Facebook Page:</strong>
                    <p>
                        @if ($governmentEntity->facebook)
                            <a href="{{ $governmentEntity->facebook }}" target="_blank"
                                class="text-blue-500 underline">{{ $governmentEntity->facebook }}</a>
                        @else
                            N/A
                        @endif
                    </p>
                </div>

                <div>
                    <strong>Instagram Page:</strong>
                    <p>
                        @if ($governmentEntity->instagram)
                            <a href="{{ $governmentEntity->instagram }}" target="_blank"
                                class="text-pink-500 underline">{{ $governmentEntity->instagram }}</a>
                        @else
                            N/A
                        @endif
                    </p>
                </div>
            </div>

            {{-- Status --}}
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Status:</h3>
                <p class="mt-1">
                    @php
                        // Example logic (you can customize this)
                        $status = $governmentEntity->status ?? 'Active';
                        $badgeColor = $status === 'Active' ? 'green' : 'red';
                    @endphp

                    <span class="inline-block px-3 py-1 text-sm font-medium rounded-full bg-{{ $badgeColor }}-100 text-{{ $badgeColor }}-800">
                        {{ $status }}
                    </span>
                </p>
            </div>
        </div>
    </div>
</x-filament-panels::page>
