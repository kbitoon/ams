<div class="p-6">
    <!-- Header with New Activity Button -->
    <div class="flex justify-between items-center mb-6">
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.activity-modal' })" class="h-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span class="hidden sm:inline">New Activity</span>
            <span class="inline sm:hidden">New</span>
        </x-primary-button>
    </div>

    <div x-data="{ openTab: 1 }">
        <!-- Tab Navigation -->
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

        <!-- Calendar View Tab -->
        <div x-show="openTab === 1" x-transition class="mt-4">
            <livewire:calendar />
        </div>

        <!-- List View Tab -->
        <div x-show="openTab === 2" x-transition class="space-y-6">
            <!-- Desktop Table View -->
            <div class="hidden md:block overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-900">
                        <tr>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Schedule</th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Title</th>
                            <th class="px-3 py-2 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($activities as $activity)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                <td class="px-3 py-2 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                    <div class="text-xs leading-tight">
                                        <div class="font-medium">{{ \Carbon\Carbon::parse($activity->start)->format('M. j, g:iA') }}</div>
                                        <div class="text-gray-500 dark:text-gray-400">to {{ \Carbon\Carbon::parse($activity->end)->format('M. j, g:iA') }}</div>
                                    </div>
                                </td>
                                <td class="px-3 py-2 text-gray-900 dark:text-gray-100">
                                    <div class="max-w-md">
                                        <div class="font-medium truncate" title="{{ $activity->title }}">{{ $activity->title }}</div>
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
                                            class="absolute right-0 z-50 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5"
                                            style="display: none;">
                                            <div class="py-1">
                                                <button 
                                                    wire:click.stop="$dispatch('openModal', { component: 'modals.activity-modal', arguments: { activity: {{ $activity->id }} }})"
                                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                    Edit
                                                </button>
                                                @hasanyrole('superadmin|administrator')
                                                <button 
                                                    x-data
                                                    @click.stop="if (confirm('Are you sure you want to delete this activity?')) { $wire.call('delete', {{ $activity->id }}) }"
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
                                <td colspan="3" class="px-3 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                                    No activities found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="md:hidden space-y-4">
                @forelse($activities as $activity)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="p-4 relative">
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex-1 min-w-0">
                                <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100 mb-2">
                                    {{ $activity->title }}
                                </h3>
                                <div class="space-y-1 text-sm text-gray-500 dark:text-gray-400">
                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                        </svg>
                                        <span>Start: {{ \Carbon\Carbon::parse($activity->start)->format('M. j, g:iA') }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                        </svg>
                                        <span>End: {{ \Carbon\Carbon::parse($activity->end)->format('M. j, g:iA') }}</span>
                                    </div>
                                </div>
                            </div>
                            @hasanyrole('superadmin|administrator')
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
                                    class="absolute right-0 z-50 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5"
                                    style="display: none;">
                                    <div class="py-1">
                                        <button 
                                            wire:click.stop="$dispatch('openModal', { component: 'modals.activity-modal', arguments: { activity: {{ $activity->id }} }})"
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                            Edit
                                        </button>
                                        <button 
                                            @click.stop="if (confirm('Are you sure you want to delete this activity?')) { $wire.call('delete', {{ $activity->id }}) }"
                                            class="block w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endhasanyrole
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 p-6 text-center">
                    <p class="text-gray-500 dark:text-gray-400">No activities found.</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $activities->links() }}
            </div>
        </div>
    </div>
</div>
