<div class="p-6">
     <!-- Info Box Section -->
     <div class="grid grid-cols-2 md:grid-cols-4 gap-4 p-4 mb-4">
        <div class="bg-blue-100 p-3 rounded shadow">
            <p class="text-sm font-semibold text-blue-600">Pending</p>
            <p class="text-lg font-bold">{{ $pendingCount }}</p>
        </div>
        <div class="bg-green-100 p-3 rounded shadow">
            <p class="text-sm font-semibold text-green-600">Resolved</p>
            <p class="text-lg font-bold">{{ $resolvedCount }}</p>
        </div>
        <div class="bg-yellow-100 p-3 rounded shadow">
            <p class="text-sm font-semibold text-yellow-600">Solved</p>
            <p class="text-lg font-bold">{{ $solvedCount }}</p>
        </div>
        <div class="bg-red-100 p-3 rounded shadow">
            <p class="text-sm font-semibold text-red-600">Dismissed</p>
            <p class="text-lg font-bold">{{ $dismissedCount }}</p>
        </div>
        <div class="bg-gray-100 p-3 rounded shadow">
            <p class="text-sm font-semibold text-gray-600">Rejected</p>
            <p class="text-lg font-bold">{{ $rejectedCount }}</p>
        </div>
        <div class="bg-purple-100 p-3 rounded shadow">
            <p class="text-sm font-semibold text-purple-600">Withdrawn</p>
            <p class="text-lg font-bold">{{ $withdrawnCount }}</p>
        </div>
        <div class="bg-orange-100 p-3 rounded shadow">
            <p class="text-sm font-semibold text-orange-600">Unsolved</p>
            <p class="text-lg font-bold">{{ $unsolvedCount }}</p>
        </div>
    </div>
    
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 p-4 bg-white shadow-md rounded-md">
    <!-- Date Filters -->
        <div class="flex flex-col sm:flex-row gap-3">
            <div class="flex items-center gap-2">
                <label class="text-sm font-semibold text-gray-600">From:</label>
                <input type="date" wire:model="startDate" 
                    class="border border-gray-300 px-3 py-2 rounded-md focus:ring focus:ring-blue-300 w-full sm:w-auto">
            </div>

            <div class="flex items-center gap-2">
                <label class="text-sm font-semibold text-gray-600">To:</label>
                <input type="date" wire:model="endDate" 
                    class="border border-gray-300 px-3 py-2 rounded-md focus:ring focus:ring-blue-300 w-full sm:w-auto">
            </div>
        </div>

        <!-- Search & Status Filters -->
        <div class="flex flex-col sm:flex-row gap-3 items-center">
            <input type="text" wire:model.debounce.500ms="search" placeholder="Search..."
                class="border border-gray-300 px-3 py-2 rounded-md focus:ring focus:ring-blue-300 w-full sm:w-64">
            
            <select wire:model="status" 
                class="border border-gray-300 px-3 py-2 rounded-md focus:ring focus:ring-blue-300 w-full sm:w-auto">
                <option value="">All Status</option>
                <option value="pending">Pending</option>
                <option value="resolved">Resolved</option>
                <option value="dismissed">Dismissed</option>
                <option value="unsolved">Unsolved</option>
                <option value="rejected">Rejected</option>
                <option value="withdrawn">Withdrawn</option>
                <option value="solved">Solved</option>
            </select>

            <!-- Search Button -->
            <x-primary-button wire:click="searchCase" class="h-10 flex items-center gap-2 px-4">
                <span class="hidden sm:inline">Search</span>
                <span class="inline sm:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                        <path fill-rule="evenodd" d="M12.9 14.32a8 8 0 111.41-1.41l3.9 3.9a1 1 0 11-1.42 1.42l-3.9-3.9zM8 14A6 6 0 108 2a6 6 0 000 12z" clip-rule="evenodd"/>
                    </svg>
                </span>
            </x-primary-button>
        </div>
    </div>


        <div class="flex justify-between items-center mb-4 mr-2 mt-4">
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.lupon-case-modal' })"
            class="h-8 mr-2">
            <span class="hidden sm:inline">New Case</span>
            <span class="inline sm:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </span>
        </x-primary-button>
       
        </div>
        <!-- Table Section -->
    <div class="overflow-x-auto">
        <table class="min-w-full border divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Case No.</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Date</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Title</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Status</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Closed</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($luponCases as $luponCase)
                    <tr class="hover:bg-gray-100 cursor-pointer"
                        wire:click="$dispatch('openModal', { component: 'modals.show.luponCase-modal', arguments: { luponCase: {{ $luponCase }} }})">
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            {{ $luponCase->case_no }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                        {{ \Carbon\Carbon::parse($luponCase->date)->format('M j, Y ') }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 capitalize">
                            {{ $luponCase->title }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 capitalize">
                            {{ $luponCase->status }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 capitalize">
                        {{ \Carbon\Carbon::parse($luponCase->end)->format('M j, Y') }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                           
                                <x-secondary-button
                                    wire:click.stop="$dispatch('openModal', { component: 'modals.lupon-case-complainant-modal', arguments: { 'lupon_case_id': {{ $luponCase->id }} }})"
                                    class="relative group">
                                    <i class="fas fa-user-plus"></i>
                                    <span
                                        class="absolute -top-8 left-1/2 -translate-x-1/2 scale-0 transition-all group-hover:scale-100 bg-gray-700 text-white text-xs rounded py-1 px-2">
                                        Add a Complainant
                                    </span>
                                </x-secondary-button>
                                <x-secondary-button
                                    wire:click.stop="$dispatch('openModal', { component: 'modals.lupon-case-respondent-modal', arguments: { lupon_case_id: {{ $luponCase->id }} }})"
                                    class="relative group">
                                    <i class="fas fa-user-friends"></i>
                                    <span
                                        class="absolute -top-8 left-1/2 -translate-x-1/2 scale-0 transition-all group-hover:scale-100 bg-gray-700 text-white text-xs rounded py-1 px-2">
                                        Add a Respondent
                                    </span>
                                </x-secondary-button>
                                <x-secondary-button
                                    wire:click.stop="$dispatch('openModal', { component: 'modals.lupon-summon-tracking-modal', arguments: { lupon_case_id: {{ $luponCase->id }} }})"
                                    class="relative group">
                                    <i class="fas fa-clipboard-list"></i>
                                    <span
                                        class="absolute -top-8 left-1/2 -translate-x-1/2 scale-0 transition-all group-hover:scale-100 bg-gray-700 text-white text-xs rounded py-1 px-2">
                                        Add Summon
                                    </span>
                                </x-secondary-button>
                                <x-secondary-button
                                    wire:click.stop="$dispatch('openModal', { component: 'modals.lupon-hearing-tracking-modal', arguments: { lupon_case_id: {{ $luponCase->id }} }})"
                                    class="relative group">
                                    <i class="fas fa-gavel"></i>
                                    <span
                                        class="absolute -top-8 left-1/2 -translate-x-1/2 scale-0 transition-all group-hover:scale-100 bg-gray-700 text-white text-xs rounded py-1 px-2">
                                        Add Hearing
                                    </span>
                                </x-secondary-button>
                                <x-secondary-button
                                    wire:click.stop="$dispatch('openModal', { component: 'modals.luponCase-modal', arguments: { luponCase: {{ $luponCase->id }} }})">
                                    <i class="fas fa-pencil-alt"></i>
                                </x-secondary-button>
                                <x-danger-button 
                                    @click="if (confirm('Are you sure you want to delete this?')) { $wire.call('delete', {{ $luponCase->id }}) }"
                                    wire:click.stop>
                                    <i class="fas fa-trash-alt"></i>
                                </x-danger-button>
                        </td>
                            
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-sm leading-5 text-gray-900">
                            No Cases found.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    <div class="mt-5">
        {{-- Pagination links --}}
        {{ $luponCases->links() }}
    </div>