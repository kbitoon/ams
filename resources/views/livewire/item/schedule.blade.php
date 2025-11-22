<div class="p-6">
    <!-- Header with New Schedule Button -->
    <div class="flex justify-between items-center mb-6">
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.itemSchedule-modal' })" class="h-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span class="hidden sm:inline">New Item Schedule</span>
            <span class="inline sm:hidden">New</span>
        </x-primary-button>
    </div>

    <!-- Filters Section -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4 sm:p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Filters</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Date Filter -->
            <div>
                <label for="dateFilter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Filter by Date</label>
                <input type="date" id="dateFilter" wire:model.defer="tempDateFilter"
                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-3 py-2">
            </div>
            <!-- Item Filter -->
            <div>
                <label for="itemFilter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Filter by Item</label>
                <select id="itemFilter" wire:model.defer="tempItemFilter"
                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-3 py-2">
                    <option value="">All Items</option>
                    @foreach($items as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- Status Filter -->
            <div>
                <label for="statusFilter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Filter by Status</label>
                <select id="statusFilter" wire:model.defer="tempStatusFilter"
                    class="mt-1 block w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-3 py-2">
                    <option value="">All Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Ongoing">Ongoing</option>
                    <option value="Done">Done</option>
                </select>
            </div>
        </div>
        <!-- Apply Filters Button -->
        <div class="mt-4 flex justify-end">
            <x-primary-button wire:click="applyFilters" class="h-10">
                Apply Filters
            </x-primary-button>
        </div>
    </div>

    <!-- Desktop Table View -->
    <div class="hidden md:block overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
            <thead class="bg-gray-50 dark:bg-gray-900">
                <tr>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Schedule</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Item</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Quantity</th>
                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                    <th class="px-3 py-2 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($itemSchedules as $itemSchedule)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors cursor-pointer"
                        wire:click="$dispatch('openModal', { component: 'modals.show.itemSchedule-modal', arguments: { itemSchedule: {{ $itemSchedule }} }})">
                        <td class="px-3 py-2 whitespace-nowrap text-gray-900 dark:text-gray-100">
                            <div class="text-xs leading-tight">
                                <div class="font-medium">{{ $itemSchedule->formatted_start }}</div>
                                <div class="text-gray-500 dark:text-gray-400">to {{ $itemSchedule->formatted_end }}</div>
                            </div>
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap text-gray-900 dark:text-gray-100">
                            <div class="font-medium">{{ $itemSchedule->item->name }}</div>
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap text-gray-900 dark:text-gray-100">
                            <div class="font-medium">{{ $itemSchedule->quantity }}</div>
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap">
                            @if($itemSchedule->status)
                                @if($itemSchedule->status === 'Pending')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                        Pending
                                    </span>
                                @elseif($itemSchedule->status === 'Ongoing')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                        Ongoing
                                    </span>
                                @elseif($itemSchedule->status === 'Done')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        Done
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                        {{ $itemSchedule->status }}
                                    </span>
                                @endif
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                    No Status
                                </span>
                            @endif
                        </td>
                        <td class="px-3 py-2 whitespace-nowrap text-right">
                            <div class="relative inline-block" x-data="{ open: false }">
                                <button 
                                    @click.stop="open = !open"
                                    class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 focus:outline-none p-1"
                                    type="button"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                                    </svg>
                                </button>
                                
                                <div 
                                    x-show="open"
                                    @click.away="open = false"
                                    x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="opacity-0 transform scale-95"
                                    x-transition:enter-end="opacity-100 transform scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="opacity-100 transform scale-100"
                                    x-transition:leave-end="opacity-0 transform scale-95"
                                    class="absolute right-0 z-50 mt-2 w-56 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5"
                                    style="display: none;">
                                    <div class="py-1">
                                        <button 
                                            wire:click.stop="$dispatch('openModal', { component: 'modals.show.itemSchedule-modal', arguments: { itemSchedule: {{ $itemSchedule }} }})"
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                            View Details
                                        </button>
                                        <button 
                                            wire:click.stop="$dispatch('openModal', { component: 'modals.item-schedule-modal', arguments: { itemSchedule: {{ $itemSchedule }} }})"
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                            Edit
                                        </button>
                                        @if($itemSchedule->status === 'Pending')
                                            <button 
                                                wire:click.stop="updateStatus({{ $itemSchedule->id }}, 'Ongoing')"
                                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                Mark as Ongoing
                                            </button>
                                        @elseif($itemSchedule->status === 'Ongoing')
                                            <button 
                                                wire:click.stop="updateStatus({{ $itemSchedule->id }}, 'Done')"
                                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                Mark as Done
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-3 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                            No item schedules found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Mobile Card View -->
    <div class="md:hidden space-y-4">
        @forelse($itemSchedules as $itemSchedule)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="p-4 relative">
                <div class="flex items-start justify-between gap-3">
                    <div class="flex-1 min-w-0 cursor-pointer" wire:click="$dispatch('openModal', { component: 'modals.show.itemSchedule-modal', arguments: { itemSchedule: {{ $itemSchedule }} }})">
                        <div class="flex items-center gap-2 mb-2">
                            <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">
                                {{ $itemSchedule->item->name }}
                            </h3>
                            @if($itemSchedule->status)
                                @if($itemSchedule->status === 'Pending')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                        Pending
                                    </span>
                                @elseif($itemSchedule->status === 'Ongoing')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                        Ongoing
                                    </span>
                                @elseif($itemSchedule->status === 'Done')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        Done
                                    </span>
                                @endif
                            @endif
                        </div>
                        <div class="space-y-1 text-sm text-gray-500 dark:text-gray-400">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                </svg>
                                <span>Start: {{ $itemSchedule->formatted_start }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                </svg>
                                <span>End: {{ $itemSchedule->formatted_end }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                </svg>
                                <span>Quantity: {{ $itemSchedule->quantity }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex-shrink-0" x-data="{ open: false }">
                        <button 
                            @click.stop="open = !open"
                            class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 focus:outline-none p-1"
                            type="button"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                            </svg>
                        </button>
                        
                        <div 
                            x-show="open"
                            @click.away="open = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="absolute right-0 z-50 mt-2 w-56 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5"
                            style="display: none;">
                            <div class="py-1">
                                <button 
                                    wire:click.stop="$dispatch('openModal', { component: 'modals.show.itemSchedule-modal', arguments: { itemSchedule: {{ $itemSchedule }} }})"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    View Details
                                </button>
                                <button 
                                    wire:click.stop="$dispatch('openModal', { component: 'modals.item-schedule-modal', arguments: { itemSchedule: {{ $itemSchedule }} }})"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Edit
                                </button>
                                @if($itemSchedule->status === 'Pending')
                                    <button 
                                        wire:click.stop="updateStatus({{ $itemSchedule->id }}, 'Ongoing')"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        Mark as Ongoing
                                    </button>
                                @elseif($itemSchedule->status === 'Ongoing')
                                    <button 
                                        wire:click.stop="updateStatus({{ $itemSchedule->id }}, 'Done')"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        Mark as Done
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 p-6 text-center">
            <p class="text-gray-500 dark:text-gray-400">No item schedules found.</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $itemSchedules->links() }}
    </div>
</div>
