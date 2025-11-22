<div class="p-6">
    <!-- Header with New Complaint button -->
    <div class="flex justify-between items-center mb-4">
        @hasanyrole('superadmin|administrator|support')
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.complaint-modal' })" class="h-8">
            <span class="hidden sm:inline">New Complaint</span>
            <span class="inline sm:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </span>
        </x-primary-button>
        @else
        <div></div>
        @endhasanyrole
    </div>

    <!-- Filters -->
    <div class="mb-4 flex flex-col sm:flex-row flex-wrap gap-4">
        <!-- Search Input -->
        <div class="flex-1 w-full sm:min-w-[200px]">
            <x-input-label for="search" value="Search by Name or Title" />
            <input 
                type="text" 
                id="search"
                wire:model.live.debounce.300ms="search" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                placeholder="Search complaints..."
            >
        </div>

        @if($search)
        <div class="w-full sm:w-auto">
            <div class="hidden sm:block h-[21px]"></div>
            <x-secondary-button wire:click="$set('search', '')" class="h-10 mt-1 w-full sm:w-auto">
                Clear Search
            </x-secondary-button>
        </div>
        @endif
    </div>

    <!-- Desktop Table View -->
    <div class="hidden md:block overflow-x-auto">
        <table class="min-w-full border divide-y divide-gray-200 dark:divide-gray-700">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left bg-gray-50 dark:bg-gray-800">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 dark:text-gray-400 uppercase">Name</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50 dark:bg-gray-800">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 dark:text-gray-400 uppercase">Title</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50 dark:bg-gray-800">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 dark:text-gray-400 uppercase">Status</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50 dark:bg-gray-800">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 dark:text-gray-400 uppercase">Date</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800"></th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($complaints as $complaint)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors cursor-pointer"
                    wire:click="$dispatch('openModal', { component: 'modals.show.complaint-modal', arguments: { complaint: {{ $complaint }} }})">
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 dark:text-gray-100">
                        {{ \Illuminate\Support\Str::title($complaint->name) }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 dark:text-gray-100">
                        {{ $complaint->title }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5">
                        @if($complaint->status === 'Pending')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                Pending
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                Done
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-500 dark:text-gray-400">
                        @if($complaint->status !== 'Done')
                            <span class="text-xs">{{ $this->getTimeAgo($complaint->created_at) }}</span>
                        @else
                            <span class="text-xs">{{ $complaint->created_at->format('M j, Y') }}</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm leading-5">
                        <div class="relative" x-data="{ open: false }">
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
                                        wire:click.stop="$dispatch('openModal', { component: 'modals.show.complaint-modal', arguments: { complaint: {{ $complaint }} }})"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        View
                                    </button>
                                    @if($complaint->status !== 'Done')
                                        @hasanyrole('superadmin|administrator|support')
                                        <button 
                                            wire:click.stop="$dispatch('openModal', { component: 'modals.complaint-modal', arguments: { complaint: {{ $complaint }} }})"
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                            Edit
                                        </button>
                                        @endhasanyrole
                                        <button 
                                            wire:click.stop="markAsDone({{ $complaint->id }})"
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
                    <td colspan="5" class="px-6 py-4 text-sm text-center text-gray-500 dark:text-gray-400">
                        No complaints found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Mobile Card View -->
    <div class="md:hidden space-y-4">
        @forelse($complaints as $complaint)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="p-4 relative">
                <div class="flex items-start justify-between gap-3">
                    <div class="flex-1 min-w-0 cursor-pointer" wire:click="$dispatch('openModal', { component: 'modals.show.complaint-modal', arguments: { complaint: {{ $complaint }} }})">
                        <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100 mb-1">
                            {{ $complaint->title }}
                        </h3>
                        <div class="space-y-1 text-sm text-gray-500 dark:text-gray-400">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                                <span>{{ \Illuminate\Support\Str::title($complaint->name) }}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                @if($complaint->status === 'Pending')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                        Pending
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        Done
                                    </span>
                                @endif
                                <span class="text-xs">
                                    @if($complaint->status !== 'Done')
                                        {{ $this->getTimeAgo($complaint->created_at) }}
                                    @else
                                        {{ $complaint->created_at->format('M j, Y') }}
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    @if($complaint->status !== 'Done')
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
                                    wire:click.stop="$dispatch('openModal', { component: 'modals.show.complaint-modal', arguments: { complaint: {{ $complaint }} }})"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    View
                                </button>
                                @hasanyrole('superadmin|administrator|support')
                                <button 
                                    wire:click.stop="$dispatch('openModal', { component: 'modals.complaint-modal', arguments: { complaint: {{ $complaint }} }})"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Edit
                                </button>
                                @endhasanyrole
                                <button 
                                    wire:click.stop="markAsDone({{ $complaint->id }})"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Mark as Done
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 p-6 text-center">
            <p class="text-gray-500 dark:text-gray-400">No complaints found.</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $complaints->links() }}
    </div>
</div>
