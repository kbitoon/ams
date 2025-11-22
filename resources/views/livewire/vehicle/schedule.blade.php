<div class="p-6">
    <!-- Header with New Schedule Button -->
    <div class="flex justify-between items-center mb-6">
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.vehicleSchedule-modal' })" class="h-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span class="hidden sm:inline">New Vehicle Schedule</span>
            <span class="inline sm:hidden">New</span>
        </x-primary-button>
    </div>

    <div x-data="{ openTab: 1 }">
        <!-- Tab Navigation -->
        @hasanyrole('superadmin|administrator|support')
        <div class="border-b border-gray-200 dark:border-gray-700 mb-6">
            <nav class="flex space-x-8" aria-label="Tabs">
                <button 
                    @click="openTab = 1"
                    :class="openTab === 1 ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                    Calendar View
                </button>
                <button 
                    @click="openTab = 2"
                    :class="openTab === 2 ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                    List View
                </button>
            </nav>
        </div>
        @endhasanyrole

        <!-- Calendar View Tab -->
        <div x-show="openTab === 1 && @json(auth()->user()->hasAnyRole(['superadmin', 'administrator', 'support']))" 
            x-transition
            class="mt-4">
            <livewire:vehicle-calendar />
        </div>

        <!-- List View Tab -->
        <div x-show="openTab === 2 || !@json(auth()->user()->hasAnyRole(['superadmin', 'administrator', 'support']))" 
            x-transition
            class="space-y-6">
            <!-- Filters Section -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4 sm:p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Filters</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Date Filter -->
                    <div>
                        <label for="dateFilter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Filter by Date</label>
                        <input type="date" id="dateFilter" wire:model.defer="tempDateFilter"
                            class="mt-1 block w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-3 py-2">
                    </div>
                    <!-- Vehicle Filter -->
                    <div>
                        <label for="vehicleFilter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Filter by Vehicle</label>
                        <select id="vehicleFilter" wire:model.defer="tempVehicleFilter"
                            class="mt-1 block w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-3 py-2">
                            <option value="">All Vehicles</option>
                            @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Status Filter -->
                    <div>
                        <label for="statusFilter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Filter by Status</label>
                        <select id="statusFilter" wire:model.defer="tempStatusFilter"
                            class="mt-1 block w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-3 py-2">
                            <option value="">All Status</option>
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
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Vehicle</th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Name / Destination</th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Driver</th>
                            @hasanyrole('superadmin|administrator|support')
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                            @endhasanyrole
                            <th class="px-3 py-2 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($vehicleSchedules as $vehicleSchedule)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors cursor-pointer"
                                wire:click="$dispatch('openModal', { component: 'modals.show.vehicleSchedule-modal', arguments: { vehicleSchedule: {{ $vehicleSchedule }} }})">
                                <td class="px-3 py-2 whitespace-nowrap {{ $vehicleSchedule->is_approved ? 'text-gray-900 dark:text-gray-100' : 'text-red-600 dark:text-red-400' }}">
                                    <div class="text-xs leading-tight">
                                        <div class="font-medium">{{ $vehicleSchedule->formatted_start }}</div>
                                        <div class="text-gray-500 dark:text-gray-400">to {{ $vehicleSchedule->formatted_end }}</div>
                                    </div>
                                </td>
                                <td class="px-3 py-2 whitespace-nowrap {{ $vehicleSchedule->is_approved ? 'text-gray-900 dark:text-gray-100' : 'text-red-600 dark:text-red-400' }}">
                                    <div class="font-medium">{{ $vehicleSchedule->vehicle->name }}</div>
                                </td>
                                <td class="px-3 py-2 {{ $vehicleSchedule->is_approved ? 'text-gray-900 dark:text-gray-100' : 'text-red-600 dark:text-red-400' }}">
                                    <div class="max-w-xs">
                                        <div class="font-medium truncate" title="{{ $vehicleSchedule->name }}">{{ $vehicleSchedule->name }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400 truncate" title="{{ $vehicleSchedule->destination }}">{{ $vehicleSchedule->destination }}</div>
                                    </div>
                                </td>
                                <td class="px-3 py-2 whitespace-nowrap {{ $vehicleSchedule->is_approved ? 'text-gray-900 dark:text-gray-100' : 'text-red-600 dark:text-red-400' }}">
                                    <div class="text-xs">{{ $vehicleSchedule->driver->name ?? 'No Driver' }}</div>
                                </td>
                                @hasanyrole('superadmin|administrator|support')
                                <td class="px-3 py-2 whitespace-nowrap">
                                    <div class="flex flex-col gap-1">
                                        @if($vehicleSchedule->status)
                                            @if($vehicleSchedule->status === 'Ongoing')
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 w-fit">
                                                    Ongoing
                                                </span>
                                            @elseif($vehicleSchedule->status === 'Done')
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 w-fit">
                                                    Done
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200 w-fit">
                                                    {{ $vehicleSchedule->status }}
                                                </span>
                                            @endif
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 w-fit">
                                                Pending
                                            </span>
                                        @endif
                                        @if(!$vehicleSchedule->is_approved)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 w-fit">
                                                Not Approved
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                @endhasanyrole
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
                                                    wire:click.stop="$dispatch('openModal', { component: 'modals.show.vehicleSchedule-modal', arguments: { vehicleSchedule: {{ $vehicleSchedule }} }})"
                                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                    View Details
                                                </button>
                                                <button 
                                                    wire:click.stop="$dispatch('openModal', { component: 'modals.vehicleSchedule-modal', arguments: { vehicleSchedule: {{ $vehicleSchedule }} }})"
                                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                    Edit
                                                </button>
                                                @hasanyrole('superadmin|administrator|support')
                                                @if(is_null($vehicleSchedule->status) || $vehicleSchedule->status === '')
                                                    <button 
                                                        wire:click.stop="markAsOngoing({{ $vehicleSchedule->id }})"
                                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                        Mark as Ongoing
                                                    </button>
                                                @elseif($vehicleSchedule->status === 'Ongoing')
                                                    <button 
                                                        wire:click.stop="markAsDone({{ $vehicleSchedule->id }})"
                                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                        Mark as Done
                                                    </button>
                                                @endif
                                                @if(!$vehicleSchedule->is_approved)
                                                    <button 
                                                        wire:click.stop="approve({{ $vehicleSchedule->id }})"
                                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                        Approve
                                                    </button>
                                                @endif
                                                @endhasanyrole
                                                @hasanyrole('superadmin')
                                                <button 
                                                    x-data
                                                    @click.stop="if (confirm('Are you sure you want to delete this schedule?')) { $wire.call('delete', {{ $vehicleSchedule->id }}) }"
                                                    class="block w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                    Delete
                                                </button>
                                                @endhasanyrole
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ auth()->user()->hasAnyRole(['superadmin', 'administrator', 'support']) ? '6' : '5' }}" class="px-3 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                    No vehicle schedules found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="md:hidden space-y-4">
                @forelse($vehicleSchedules as $vehicleSchedule)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="p-4 relative">
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex-1 min-w-0 cursor-pointer" wire:click="$dispatch('openModal', { component: 'modals.show.vehicleSchedule-modal', arguments: { vehicleSchedule: {{ $vehicleSchedule }} }})">
                                <div class="flex items-center gap-2 mb-2">
                                    <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">
                                        {{ $vehicleSchedule->name }}
                                    </h3>
                                    @if(!$vehicleSchedule->is_approved)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                            Not Approved
                                        </span>
                                    @endif
                                </div>
                                <div class="space-y-1 text-sm {{ $vehicleSchedule->is_approved ? 'text-gray-500 dark:text-gray-400' : 'text-red-500 dark:text-red-400' }}">
                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.8c0-.568.422-1.048.987-1.106a48.554 48.554 0 0110.026 0c.565.058.987.538.987 1.106v.8M12.75 18.75h-1.5M12.75 18.75h-1.5" />
                                        </svg>
                                        <span>{{ $vehicleSchedule->vehicle->name }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                        </svg>
                                        <span>Start: {{ $vehicleSchedule->formatted_start }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                        </svg>
                                        <span>End: {{ $vehicleSchedule->formatted_end }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                        </svg>
                                        <span>{{ $vehicleSchedule->destination }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                        </svg>
                                        <span>Driver: {{ $vehicleSchedule->driver->name ?? 'No Driver Assigned' }}</span>
                                    </div>
                                    @hasanyrole('superadmin|administrator|support')
                                    @if($vehicleSchedule->status)
                                        <div class="mt-2">
                                            @if($vehicleSchedule->status === 'Ongoing')
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                    Ongoing
                                                </span>
                                            @elseif($vehicleSchedule->status === 'Done')
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                    Done
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                                    {{ $vehicleSchedule->status }}
                                                </span>
                                            @endif
                                        </div>
                                    @else
                                        <div class="mt-2">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                                Pending
                                            </span>
                                        </div>
                                    @endif
                                    @endhasanyrole
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
                                            wire:click.stop="$dispatch('openModal', { component: 'modals.show.vehicleSchedule-modal', arguments: { vehicleSchedule: {{ $vehicleSchedule }} }})"
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                            View Details
                                        </button>
                                        <button 
                                            wire:click.stop="$dispatch('openModal', { component: 'modals.vehicleSchedule-modal', arguments: { vehicleSchedule: {{ $vehicleSchedule }} }})"
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                            Edit
                                        </button>
                                        @hasanyrole('superadmin|administrator|support')
                                        @if(is_null($vehicleSchedule->status) || $vehicleSchedule->status === '')
                                            <button 
                                                wire:click.stop="markAsOngoing({{ $vehicleSchedule->id }})"
                                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                Mark as Ongoing
                                            </button>
                                        @elseif($vehicleSchedule->status === 'Ongoing')
                                            <button 
                                                wire:click.stop="markAsDone({{ $vehicleSchedule->id }})"
                                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                Mark as Done
                                            </button>
                                        @endif
                                        @if(!$vehicleSchedule->is_approved)
                                            <button 
                                                wire:click.stop="approve({{ $vehicleSchedule->id }})"
                                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                Approve
                                            </button>
                                        @endif
                                        @endhasanyrole
                                        @hasanyrole('superadmin')
                                        <button 
                                            @click.stop="if (confirm('Are you sure you want to delete this schedule?')) { $wire.call('delete', {{ $vehicleSchedule->id }}) }"
                                            class="block w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                                            Delete
                                        </button>
                                        @endhasanyrole
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 p-6 text-center">
                    <p class="text-gray-500 dark:text-gray-400">No vehicle schedules found.</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $vehicleSchedules->links() }}
            </div>
        </div>
    </div>
</div>
