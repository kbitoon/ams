<div class="min-w-full align-middle">
    <!-- Header with New Incident Report button -->
    <div class="flex justify-between items-center mb-4">
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.incident-report-modal' })" class="h-8">
            <span class="hidden sm:inline">New Incident</span>
            <span class="inline sm:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </span>
        </x-primary-button>
    </div>

    <!-- Filters -->
    <div class="mb-4 flex flex-col sm:flex-row flex-wrap gap-4">
        <!-- Search Input -->
        <div class="flex-1 w-full sm:min-w-[200px]">
            <x-input-label for="search" value="Search" />
            <input 
                type="text" 
                id="search"
                wire:model.live.debounce.300ms="search" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                placeholder="Search by title, name, or narration..."
            >
        </div>

        @if($search)
        <div class="w-full sm:w-auto">
            <div class="hidden sm:block h-[21px]"></div>
            <x-secondary-button wire:click="resetFilters" class="h-10 mt-1 w-full sm:w-auto">
                Clear Filter
            </x-secondary-button>
        </div>
        @endif
    </div>

    <!-- Desktop Table View -->
    <div class="hidden md:block overflow-x-auto">
        <table class="min-w-full border divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                        Title
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                        Name
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                        Incident Date
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($incidentReports as $incidentReport)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer transition-colors"
                    wire:click="$dispatch('openModal', { component: 'modals.show.incident-report-modal', arguments: { incidentReport: {{ $incidentReport }} }})">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                            {{ $incidentReport->title }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                        {{ $incidentReport->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                        {{ \Carbon\Carbon::parse($incidentReport->date)->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        @hasanyrole('superadmin|administrator')
                        <div class="flex items-center justify-end gap-2" x-data="{ open: false }" @click.stop>
                            <button 
                                @click="open = !open"
                                class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors"
                                title="Actions">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                                </svg>
                            </button>
                            <div 
                                x-show="open"
                                @click.away="open = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute z-50 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5"
                                style="display: none;">
                                <div class="py-1">
                                    <button 
                                        wire:click="$dispatch('openModal', { component: 'modals.incident-report-modal', arguments: { incidentReport: {{ $incidentReport->id }} }})"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        Edit
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endhasanyrole
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-sm text-center text-gray-500 dark:text-gray-400">
                        No incident reports found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Mobile Card View -->
    <div class="md:hidden space-y-4">
        @forelse($incidentReports as $incidentReport)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="p-4 relative">
                <div class="flex items-start justify-between gap-3">
                    <div class="flex-1 min-w-0 cursor-pointer" wire:click="$dispatch('openModal', { component: 'modals.show.incident-report-modal', arguments: { incidentReport: {{ $incidentReport }} }})">
                        <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100 mb-2">
                            {{ $incidentReport->title }}
                        </h3>
                        <div class="space-y-1 text-sm text-gray-500 dark:text-gray-400">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                                <span>{{ $incidentReport->name }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                </svg>
                                <span>{{ \Carbon\Carbon::parse($incidentReport->date)->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                    @hasanyrole('superadmin|administrator')
                    <div class="flex-shrink-0 relative" x-data="{ open: false }" @click.stop>
                        <button 
                            @click="open = !open"
                            class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors"
                            title="Actions">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                            </svg>
                        </button>
                        <div 
                            x-show="open"
                            @click.away="open = false"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 z-50 mt-2 w-48 rounded-md shadow-lg bg-white dark:bg-gray-800 ring-1 ring-black ring-opacity-5"
                            style="display: none;">
                            <div class="py-1">
                                <button 
                                    wire:click="$dispatch('openModal', { component: 'modals.show.incident-report-modal', arguments: { incidentReport: {{ $incidentReport }} }})"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    View
                                </button>
                                <button 
                                    wire:click="$dispatch('openModal', { component: 'modals.incident-report-modal', arguments: { incidentReport: {{ $incidentReport->id }} }})"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </div>
                    @endhasanyrole
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 p-6 text-center">
            <p class="text-sm text-gray-500 dark:text-gray-400">No incident reports found.</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-5">
        {{ $incidentReports->links() }}
    </div>
</div>
