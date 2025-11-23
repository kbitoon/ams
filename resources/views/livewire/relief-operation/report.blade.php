<div class="p-6">
    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">Relief Distribution Reports</h2>
    
    <!-- Date Range Filters -->
    <div class="mb-6 bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
            <div>
                <x-input-label for="startDate" value="Start Date" />
                <input type="date" wire:model.live="startDate" id="startDate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
            <div>
                <x-input-label for="endDate" value="End Date" />
                <input type="date" wire:model.live="endDate" id="endDate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
            <div>
                <x-input-label for="selectedOperationId" value="Operation" />
                <select wire:model.live="selectedOperationId" id="selectedOperationId" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="">All Operations</option>
                    @foreach($operations as $operation)
                        <option value="{{ $operation->id }}">{{ $operation->title }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <x-input-label for="selectedTypeId" value="Relief Type" />
                <select wire:model.live="selectedTypeId" id="selectedTypeId" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="">All Types</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mt-4">
            <x-secondary-button wire:click="resetFilters">Reset Filters</x-secondary-button>
        </div>
    </div>

    <!-- Summary Statistics -->
    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mb-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-5">
            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Distributions</p>
            <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 mt-1">{{ number_format($totalDistributions) }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-5">
            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Recipients</p>
            <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 mt-1">{{ number_format($totalRecipients) }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-5">
            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Quantity</p>
            <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 mt-1">{{ number_format($totalQuantity, 2) }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-5">
            <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Amount</p>
            <p class="text-2xl font-bold text-indigo-600 dark:text-indigo-400 mt-1">₱{{ number_format($totalAmount, 2) }}</p>
        </div>
    </div>

    <!-- Reports Tables -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-6">
        <h3 class="text-lg font-semibold mb-4">Distributions by Operation</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Operation</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Count</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($byOperation as $item)
                        <tr>
                            <td class="px-4 py-2 text-sm">{{ $item->title }}</td>
                            <td class="px-4 py-2 text-sm">{{ number_format($item->count) }}</td>
                            <td class="px-4 py-2 text-sm">{{ number_format($item->total_quantity, 2) }}</td>
                            <td class="px-4 py-2 text-sm">₱{{ number_format($item->total_amount, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4">Distributions by Provider</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Provider</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Count</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($byProvider as $provider)
                        <tr>
                            <td class="px-4 py-2 text-sm">{{ $provider->name ?? 'Unknown' }}</td>
                            <td class="px-4 py-2 text-sm">{{ $provider->type ? ucfirst($provider->type) : 'N/A' }}</td>
                            <td class="px-4 py-2 text-sm">{{ number_format($provider->count) }}</td>
                            <td class="px-4 py-2 text-sm">{{ number_format($provider->total_quantity, 2) }}</td>
                            <td class="px-4 py-2 text-sm">₱{{ number_format($provider->total_amount, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

