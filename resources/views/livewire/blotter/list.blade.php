<div class="p-6">
    <!-- Header with New Blotter button -->
    <div class="flex justify-between items-center mb-4">
        @hasanyrole('superadmin|administrator|support')
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.blotter-modal' })" class="h-8">
            <span class="hidden sm:inline">New Blotter</span>
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

    <!-- Desktop Table View -->
    <div class="hidden md:block overflow-x-auto">
        <table class="min-w-full border divide-y divide-gray-200 dark:divide-gray-700">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left bg-gray-50 dark:bg-gray-800">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 dark:text-gray-400 uppercase">Date of Incident</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50 dark:bg-gray-800">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 dark:text-gray-400 uppercase">Date Reported</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50 dark:bg-gray-800">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 dark:text-gray-400 uppercase">Complainant</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50 dark:bg-gray-800">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 dark:text-gray-400 uppercase">Respondent</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 dark:bg-gray-800"></th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($blotters as $blotter)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors cursor-pointer"
                    wire:click="$dispatch('openModal', { component: 'modals.show.blotter-modal', arguments: { blotter: {{ $blotter }} }})">
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 dark:text-gray-100">
                        {{ \Carbon\Carbon::parse($blotter->incident)->format('M j, Y g:i A') }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-500 dark:text-gray-400">
                        {{ \Carbon\Carbon::parse($blotter->reported)->format('M j, Y') }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 dark:text-gray-100">
                        {{ trim("{$blotter->firstname} {$blotter->lastname}") }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 dark:text-gray-100">
                        {{ optional($blotter->complainee)->first ?? 'N/A' }} {{ optional($blotter->complainee)->last ?? '' }}
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
                                        wire:click.stop="$dispatch('openModal', { component: 'modals.show.blotter-modal', arguments: { blotter: {{ $blotter }} }})"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        View
                                    </button>
                                    @hasanyrole('superadmin|administrator')
                                    @if (is_null($blotter->complainee_id))
                                    <button 
                                        wire:click.stop="$dispatch('openModal', { component: 'modals.complainee-modal', arguments: { blotter: {{ $blotter->id }} }})"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        Add Respondent
                                    </button>
                                    @endif
                                    <button 
                                        wire:click.stop="$dispatch('openModal', { component: 'modals.blotter-modal', arguments: { blotter: {{ $blotter->id }} }})"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        Edit
                                    </button>
                                    @hasanyrole('superadmin')
                                    <button 
                                        @click.stop="if (confirm('Are you sure you want to delete this?')) { $wire.call('delete', {{ $blotter->id }}) }"
                                        class="block w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        Delete
                                    </button>
                                    @endhasanyrole
                                    @endhasanyrole
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-sm text-center text-gray-500 dark:text-gray-400">
                        No blotters found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Mobile Card View -->
    <div class="md:hidden space-y-4">
        @forelse($blotters as $blotter)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="p-4 relative">
                <div class="flex items-start justify-between gap-3">
                    <div class="flex-1 min-w-0 cursor-pointer" wire:click="$dispatch('openModal', { component: 'modals.show.blotter-modal', arguments: { blotter: {{ $blotter }} }})">
                        <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100 mb-2">
                            {{ trim("{$blotter->firstname} {$blotter->lastname}") }}
                        </h3>
                        <div class="space-y-1 text-sm text-gray-500 dark:text-gray-400">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                                </svg>
                                <span>Incident: {{ \Carbon\Carbon::parse($blotter->incident)->format('M j, Y g:i A') }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                </svg>
                                <span>Reported: {{ \Carbon\Carbon::parse($blotter->reported)->format('M j, Y') }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                                <span>Respondent: {{ optional($blotter->complainee)->first ?? 'N/A' }} {{ optional($blotter->complainee)->last ?? '' }}</span>
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
                                    wire:click.stop="$dispatch('openModal', { component: 'modals.show.blotter-modal', arguments: { blotter: {{ $blotter }} }})"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    View
                                </button>
                                @if (is_null($blotter->complainee_id))
                                <button 
                                    wire:click.stop="$dispatch('openModal', { component: 'modals.complainee-modal', arguments: { blotter: {{ $blotter->id }} }})"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Add Respondent
                                </button>
                                @endif
                                <button 
                                    wire:click.stop="$dispatch('openModal', { component: 'modals.blotter-modal', arguments: { blotter: {{ $blotter->id }} }})"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Edit
                                </button>
                                @hasanyrole('superadmin')
                                <button 
                                    @click.stop="if (confirm('Are you sure you want to delete this?')) { $wire.call('delete', {{ $blotter->id }}) }"
                                    class="block w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Delete
                                </button>
                                @endhasanyrole
                            </div>
                        </div>
                    </div>
                    @endhasanyrole
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 p-6 text-center">
            <p class="text-gray-500 dark:text-gray-400">No blotters found.</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $blotters->links() }}
    </div>
</div>
