<x-filament-panels::page>
    <div class="space-y-6">

        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Customer Details</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <h3 class="font-semibold text-gray-700 dark:text-gray-300">First Name</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $customer->first_name }}</p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-700 dark:text-gray-300">Last Name</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $customer->last_name }}</p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-700 dark:text-gray-300">Phone Number</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $customer->phone_number }}</p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-700 dark:text-gray-300">Image</h3>
                @if($customer->image)
                    <img src="{{ asset('storage/' . $customer->image) }}" alt="Customer Image" class="w-24 h-24 rounded-lg object-cover border">
                @else
                    <p class="text-sm text-gray-500">No image provided</p>
                @endif
            </div>

            <div>
                <h3 class="font-semibold text-gray-700 dark:text-gray-300">State</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $customer->state->name ?? 'N/A' }}</p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-700 dark:text-gray-300">City</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $customer->city->name ?? 'N/A' }}</p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-700 dark:text-gray-300">Created At</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $customer->created_at->format('Y-m-d H:i') }}</p>
            </div>

            <div>
                <h3 class="font-semibold text-gray-700 dark:text-gray-300">Status</h3>
                <p class="inline-block px-2 py-1 text-xs rounded-full font-semibold
                    @class([
                        'bg-green-100 text-green-800' => $customer->status->value === 'active',
                        'bg-yellow-100 text-yellow-800' => $customer->status->value === 'inactive',
                        'bg-red-100 text-red-800' => $customer->status->value === 'suspended',
                    ])
                ">
                    {{ $customer->status->translate() }}
                </p>
            </div>

        </div>
    </div>
</x-filament-panels::page>
