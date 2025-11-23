<div class="p-6 max-h-[90vh] overflow-y-auto">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    
    @if($operation)
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">{{ $operation->title }}</h2>
        
        <div class="mb-6">
            <p class="text-sm text-gray-600 dark:text-gray-400">Purpose: {{ $operation->purpose ?? 'N/A' }}</p>
            <p class="text-sm text-gray-600 dark:text-gray-400">Date: {{ $operation->operation_date->format('F d, Y') }}</p>
            @if($operation->provider)
                <p class="text-sm text-gray-600 dark:text-gray-400">Provider: {{ $operation->provider->name }}</p>
            @endif
        </div>

        <div class="mb-6">
            <div class="flex justify-between items-center mb-2">
                <h3 class="text-lg font-semibold">Relief Items</h3>
                <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.relief-item-modal', arguments: { operation: {{ $operation->id }} } })" size="sm">
                    <i class="fas fa-plus mr-1"></i> Add Item
                </x-primary-button>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Received</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Distributed</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Remaining</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($operation->reliefItems as $item)
                            <tr>
                                <td class="px-4 py-2 text-sm">{{ $item->reliefType->name }}</td>
                                <td class="px-4 py-2 text-sm">{{ number_format($item->quantity_received, 2) }} {{ $item->reliefType->unit }}</td>
                                <td class="px-4 py-2 text-sm">{{ number_format($item->quantity_distributed, 2) }} {{ $item->reliefType->unit }}</td>
                                <td class="px-4 py-2 text-sm">{{ number_format($item->quantity_remaining, 2) }} {{ $item->reliefType->unit }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            <div class="flex justify-between items-center mb-2">
                <h3 class="text-lg font-semibold">Distributions</h3>
                <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.relief-distribution-modal', arguments: { operation: {{ $operation->id }} } })" size="sm">
                    <i class="fas fa-plus mr-1"></i> Record Distribution
                </x-primary-button>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Recipient</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Item</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($operation->distributions as $distribution)
                            <tr>
                                <td class="px-4 py-2 text-sm">{{ $distribution->distributed_at->format('M d, Y H:i') }}</td>
                                <td class="px-4 py-2 text-sm">{{ ucfirst($distribution->distribution_type) }}</td>
                                <td class="px-4 py-2 text-sm">
                                    @if($distribution->distribution_type === 'family')
                                        {{ $distribution->headOfFamily->name }} (Family)
                                    @else
                                        {{ $distribution->user->name }}
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-sm">{{ $distribution->reliefItem->reliefType->name }}</td>
                                <td class="px-4 py-2 text-sm">{{ number_format($distribution->quantity, 2) }} {{ $distribution->reliefItem->reliefType->unit }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>

