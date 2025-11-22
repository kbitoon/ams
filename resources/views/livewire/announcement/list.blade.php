<div class="min-w-full align-middle">
    <!-- Header with New Announcement button -->
    <div class="flex justify-between items-center mb-4">
        @hasanyrole('superadmin|administrator')
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.announcement-modal' })" class="h-8">
            <span class="hidden sm:inline">New Announcement</span>
            <span class="inline sm:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </span>
        </x-primary-button>
        @endhasanyrole
    </div>

    <!-- Filters -->
    <div class="mb-4 flex flex-col sm:flex-row flex-wrap gap-4">
        <!-- Search Input -->
        <div class="flex-1 w-full sm:min-w-[200px]">
            <x-input-label for="search" value="Search by Title" />
            <input 
                type="text" 
                id="search"
                wire:model.live.debounce.300ms="search" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                placeholder="Search by title..."
            >
        </div>

        @if($search)
        <div class="w-full sm:w-auto">
            <div class="hidden sm:block h-[21px]"></div>
            <x-secondary-button wire:click="$set('search', '')" class="h-10 mt-1 w-full sm:w-auto">
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
                        Date Created
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($announcements as $announcement)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 cursor-pointer transition-colors"
                    wire:click="$dispatch('openModal', { component: 'modals.show.announcement-modal', arguments: { announcement: {{ $announcement }} }})">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-2">
                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                {{ $announcement->title }}
                            </div>
                            @if($announcement->is_pinned)
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                                Pinned
                            </span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                        {{ $announcement->created_at->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($announcement->category)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                            {{ $announcement->category->name }}
                        </span>
                        @else
                        <span class="text-sm text-gray-400 dark:text-gray-500">—</span>
                        @endif
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
                                        wire:click="$dispatch('openModal', { component: 'modals.announcement-modal', arguments: { announcement: {{ $announcement }} }})"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        Edit
                                    </button>
                                    <button 
                                        wire:click="pinned_announcement({{ $announcement->id }})"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        {{ $announcement->is_pinned ? 'Unpin' : 'Pin' }}
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
                        No announcements available.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Mobile Card View -->
    <div class="md:hidden space-y-4">
        @forelse($announcements as $announcement)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="p-4 relative">
                <div class="flex items-start justify-between gap-3">
                    <div class="flex-1 min-w-0 cursor-pointer" wire:click="$dispatch('openModal', { component: 'modals.show.announcement-modal', arguments: { announcement: {{ $announcement }} }})">
                        <div class="flex items-center gap-2 mb-2">
                            <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100 truncate">
                                {{ $announcement->title }}
                            </h3>
                            @if($announcement->is_pinned)
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                                Pinned
                            </span>
                            @endif
                        </div>
                        <div class="flex items-center gap-3 text-sm text-gray-500 dark:text-gray-400">
                            <span>{{ $announcement->created_at->format('M d, Y') }}</span>
                            @if($announcement->category)
                            <span class="text-gray-300 dark:text-gray-600">•</span>
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                {{ $announcement->category->name }}
                            </span>
                            @endif
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
                                    wire:click="$dispatch('openModal', { component: 'modals.show.announcement-modal', arguments: { announcement: {{ $announcement }} }})"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    View
                                </button>
                                <button 
                                    wire:click="$dispatch('openModal', { component: 'modals.announcement-modal', arguments: { announcement: {{ $announcement }} }})"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Edit
                                </button>
                                <button 
                                    wire:click="pinned_announcement({{ $announcement->id }})"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    {{ $announcement->is_pinned ? 'Unpin' : 'Pin' }}
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
            <p class="text-sm text-gray-500 dark:text-gray-400">No announcements available.</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-5">
        {{ $announcements->links() }}
    </div>
</div>
