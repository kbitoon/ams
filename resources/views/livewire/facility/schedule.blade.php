<div class="p-6">
    <!-- Header with New Schedule Button -->
    <div class="flex justify-between items-center mb-6">
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.facilitySchedule-modal' })" class="h-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span class="hidden sm:inline">New Facility Schedule</span>
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
            <livewire:facility-calendar />
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
                    <!-- Facility Filter -->
                    <div>
                        <label for="facilityFilter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Filter by Facility</label>
                        <select id="facilityFilter" wire:model.defer="tempFacilityFilter"
                            class="mt-1 block w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm px-3 py-2">
                            <option value="">All Facilities</option>
                            @foreach($facilities as $facility)
                                <option value="{{ $facility->id }}">{{ $facility->name }}</option>
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
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Facility</th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Name / Purpose</th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                            <th class="px-3 py-2 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($facilitySchedules as $facilitySchedule)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                <td class="px-3 py-2 whitespace-nowrap {{ $facilitySchedule->is_approved ? 'text-gray-900 dark:text-gray-100' : 'text-red-600 dark:text-red-400' }}">
                                    <div class="text-xs leading-tight">
                                        <div class="font-medium">{{ $facilitySchedule->formatted_start }}</div>
                                        <div class="text-gray-500 dark:text-gray-400">to {{ $facilitySchedule->formatted_end }}</div>
                                    </div>
                                </td>
                                <td class="px-3 py-2 whitespace-nowrap {{ $facilitySchedule->is_approved ? 'text-gray-900 dark:text-gray-100' : 'text-red-600 dark:text-red-400' }}">
                                    <div class="font-medium">{{ $facilitySchedule->facility->name }}</div>
                                </td>
                                <td class="px-3 py-2 {{ $facilitySchedule->is_approved ? 'text-gray-900 dark:text-gray-100' : 'text-red-600 dark:text-red-400' }}">
                                    <div class="max-w-xs">
                                        <div class="font-medium truncate" title="{{ $facilitySchedule->name }}">{{ $facilitySchedule->name }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400 truncate" title="{{ $facilitySchedule->purpose }}">{{ $facilitySchedule->purpose }}</div>
                                    </div>
                                </td>
                                <td class="px-3 py-2 whitespace-nowrap">
                                    <div class="flex flex-col gap-1">
                                        @if($facilitySchedule->status)
                                            @if($facilitySchedule->status === 'Ongoing')
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 w-fit">
                                                    Ongoing
                                                </span>
                                            @elseif($facilitySchedule->status === 'Done')
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 w-fit">
                                                    Done
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200 w-fit">
                                                    {{ $facilitySchedule->status }}
                                                </span>
                                            @endif
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 w-fit">
                                                Pending
                                            </span>
                                        @endif
                                        @if(!$facilitySchedule->is_approved)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 w-fit">
                                                Not Approved
                                            </span>
                                        @endif
                                    </div>
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
                                                    wire:click.stop="$dispatch('openModal', { component: 'modals.facilitySchedule-modal', arguments: { facilitySchedule: {{ $facilitySchedule }} }})"
                                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                    Edit
                                                </button>
                                                @hasanyrole('superadmin|administrator|support')
                                                @if(is_null($facilitySchedule->status) || $facilitySchedule->status === '')
                                                    <button 
                                                        wire:click.stop="markAsOngoing({{ $facilitySchedule->id }})"
                                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                        Mark as Ongoing
                                                    </button>
                                                    <button 
                                                        wire:click.stop="markAsDone({{ $facilitySchedule->id }})"
                                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                        Mark as Done
                                                    </button>
                                                @elseif($facilitySchedule->status === 'Ongoing')
                                                    <button 
                                                        wire:click.stop="markAsDone({{ $facilitySchedule->id }})"
                                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                        Mark as Done
                                                    </button>
                                                @elseif($facilitySchedule->status !== 'Done')
                                                    <button 
                                                        wire:click.stop="markAsDone({{ $facilitySchedule->id }})"
                                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                        Mark as Done
                                                    </button>
                                                @endif
                                                @if(!$facilitySchedule->is_approved)
                                                    <button 
                                                        wire:click.stop="approve({{ $facilitySchedule->id }})"
                                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                        Approve
                                                    </button>
                                                @endif
                                                @endhasanyrole
                                                @hasanyrole('superadmin')
                                                <button 
                                                    x-data
                                                    @click.stop="if (confirm('Are you sure you want to delete this schedule?')) { $wire.call('delete', {{ $facilitySchedule->id }}) }"
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
                                <td colspan="5" class="px-3 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                    No facility schedules found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="md:hidden space-y-4">
                @forelse($facilitySchedules as $facilitySchedule)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="p-4 relative">
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-2">
                                    <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">
                                        {{ $facilitySchedule->name }}
                                    </h3>
                                    @if(!$facilitySchedule->is_approved)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                            Not Approved
                                        </span>
                                    @endif
                                </div>
                                <div class="space-y-1 text-sm {{ $facilitySchedule->is_approved ? 'text-gray-500 dark:text-gray-400' : 'text-red-500 dark:text-red-400' }}">
                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                                        </svg>
                                        <span>{{ $facilitySchedule->facility->name }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                        </svg>
                                        <span>Start: {{ $facilitySchedule->formatted_start }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                        </svg>
                                        <span>End: {{ $facilitySchedule->formatted_end }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h11.25c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                                        </svg>
                                        <span>{{ $facilitySchedule->purpose }}</span>
                                    </div>
                                    @if($facilitySchedule->status)
                                        <div class="mt-2">
                                            @if($facilitySchedule->status === 'Ongoing')
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                    Ongoing
                                                </span>
                                            @elseif($facilitySchedule->status === 'Done')
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                    Done
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                                    {{ $facilitySchedule->status }}
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
                                            wire:click.stop="$dispatch('openModal', { component: 'modals.facilitySchedule-modal', arguments: { facilitySchedule: {{ $facilitySchedule }} }})"
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                            Edit
                                        </button>
                                        @hasanyrole('superadmin|administrator|support')
                                        @if(is_null($facilitySchedule->status) || $facilitySchedule->status === '')
                                            <button 
                                                wire:click.stop="markAsOngoing({{ $facilitySchedule->id }})"
                                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                Mark as Ongoing
                                            </button>
                                            <button 
                                                wire:click.stop="markAsDone({{ $facilitySchedule->id }})"
                                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                Mark as Done
                                            </button>
                                        @elseif($facilitySchedule->status === 'Ongoing')
                                            <button 
                                                wire:click.stop="markAsDone({{ $facilitySchedule->id }})"
                                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                Mark as Done
                                            </button>
                                        @elseif($facilitySchedule->status !== 'Done')
                                            <button 
                                                wire:click.stop="markAsDone({{ $facilitySchedule->id }})"
                                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                Mark as Done
                                            </button>
                                        @endif
                                        @if(!$facilitySchedule->is_approved)
                                            <button 
                                                wire:click.stop="approve({{ $facilitySchedule->id }})"
                                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                Approve
                                            </button>
                                        @endif
                                        @endhasanyrole
                                        @hasanyrole('superadmin')
                                        <button 
                                            @click.stop="if (confirm('Are you sure you want to delete this schedule?')) { $wire.call('delete', {{ $facilitySchedule->id }}) }"
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
                    <p class="text-gray-500 dark:text-gray-400">No facility schedules found.</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $facilitySchedules->links() }}
            </div>
        </div>
    </div>
</div>
