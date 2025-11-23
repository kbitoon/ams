<div class="p-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Relief Operations</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Manage relief operations and track distributions</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <x-secondary-button wire:click="$dispatch('openModal', { component: 'modals.relief-report-modal' })">
                <i class="fas fa-chart-bar mr-2"></i> Reports
            </x-secondary-button>
            <x-secondary-button href="{{ route('relief-type') }}" wire:navigate>
                <i class="fas fa-tags mr-2"></i> Relief Types
            </x-secondary-button>
            <x-secondary-button href="{{ route('relief-provider') }}" wire:navigate>
                <i class="fas fa-building mr-2"></i> Providers
            </x-secondary-button>
            <x-secondary-button href="{{ route('family') }}" wire:navigate>
                <i class="fas fa-users mr-2"></i> Families
            </x-secondary-button>
            <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.relief-operation-modal' })">
                <i class="fas fa-plus mr-2"></i> New Operation
            </x-primary-button>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <x-input-label for="search" value="Search" />
                <x-text-input wire:model.debounce.500ms="search" id="search" class="mt-1 block w-full" placeholder="Search operations..." />
            </div>
            <div>
                <x-input-label for="statusFilter" value="Status" />
                <select wire:model.live="statusFilter" id="statusFilter" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="">All Status</option>
                    <option value="active">Active</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
            <div>
                <x-input-label for="startDate" value="Start Date" />
                <input type="date" wire:model.live="startDate" id="startDate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
            <div>
                <x-input-label for="endDate" value="End Date" />
                <input type="date" wire:model.live="endDate" id="endDate" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
        </div>
        @if($search || $statusFilter || $startDate || $endDate)
            <div class="mt-4">
                <x-secondary-button wire:click="resetFilters" size="sm">Clear Filters</x-secondary-button>
            </div>
        @endif
    </div>

    <!-- Operations List -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-900">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Operation</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Purpose</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Provider</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Items</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Distributions</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($operations as $operation)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button 
                                    wire:click="$dispatch('openModal', { component: 'modals.relief-operation-view-modal', arguments: { operation: {{ $operation->id }} } })"
                                    class="text-sm font-medium text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 cursor-pointer hover:underline"
                                >
                                    {{ $operation->title }}
                                </button>
                                @if($operation->description)
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ Str::limit($operation->description, 50) }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-gray-100">{{ $operation->purpose ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-gray-100">{{ $operation->operation_date->format('M d, Y') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($operation->provider)
                                    <div class="text-sm text-gray-900 dark:text-gray-100">{{ $operation->provider->name }}</div>
                                    @if($operation->provider->type)
                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ ucfirst($operation->provider->type) }}</div>
                                    @endif
                                @else
                                    <span class="text-sm text-gray-400">N/A</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                    {{ $operation->relief_items_count }} items
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                    {{ $operation->distributions_count }} distributions
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($operation->status === 'active')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                        Active
                                    </span>
                                @elseif($operation->status === 'completed')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        Completed
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                        Cancelled
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button wire:click="$dispatch('openModal', { component: 'modals.relief-operation-view-modal', arguments: { operation: {{ $operation->id }} } })" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 mr-3">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button wire:click="$dispatch('openModal', { component: 'modals.relief-operation-modal', arguments: { operation: {{ $operation->id }} } })" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                No relief operations found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
            {{ $operations->links() }}
        </div>
    </div>
</div>

