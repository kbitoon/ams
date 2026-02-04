<div class="p-6">
    <!-- Statistics Cards Section -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-lg p-4 sm:p-6 text-white transform transition-transform hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm sm:text-base font-medium opacity-90">Pending</p>
                    <p class="text-2xl sm:text-3xl font-bold mt-1">{{ $pendingCount }}</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 sm:w-10 sm:h-10 opacity-80">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-lg p-4 sm:p-6 text-white transform transition-transform hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm sm:text-base font-medium opacity-90">Settled</p>
                    <p class="text-2xl sm:text-3xl font-bold mt-1">{{ $settledCount }}</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 sm:w-10 sm:h-10 opacity-80">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
        <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-lg shadow-lg p-4 sm:p-6 text-white transform transition-transform hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm sm:text-base font-medium opacity-90">Mediation</p>
                    <p class="text-2xl sm:text-3xl font-bold mt-1">{{ $mediatedCount }}</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 sm:w-10 sm:h-10 opacity-80">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-lg shadow-lg p-4 sm:p-6 text-white transform transition-transform hover:scale-105">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm sm:text-base font-medium opacity-90">Conciliation</p>
                    <p class="text-2xl sm:text-3xl font-bold mt-1">{{ $conciliatedCount }}</p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 sm:w-10 sm:h-10 opacity-80">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4 sm:p-6 mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-gray-100">
                Lupon Cases ({{ $selectedYear }})
            </h2>
            <div class="w-full sm:w-auto">
                <select id="selectedYear" wire:model.live="selectedYear"
                    class="w-full sm:w-auto border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-4 py-2 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    @foreach($availableYears as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="w-full h-64 sm:h-80" wire:ignore>
            <canvas id="casesChart"></canvas>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4 sm:p-6 mb-6">
        <div class="flex flex-col lg:flex-row gap-4">
            <!-- Date Filters -->
            <div class="flex flex-col sm:flex-row gap-3 flex-1">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">From Date</label>
                    <input type="date" wire:model.live="startDate"
                        class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-3 py-2 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">To Date</label>
                    <input type="date" wire:model.live="endDate"
                        class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-3 py-2 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
            </div>

            <!-- Search & Status Filters -->
            <div class="flex flex-col sm:flex-row gap-3 flex-1">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Search</label>
                    <input type="text" wire:model.live.debounce.500ms="search" placeholder="Search by case no, title, or name..."
                        class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-3 py-2 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div class="sm:w-48">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                    <select wire:model.live="status"
                        class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-3 py-2 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="mediation">Mediation</option>
                        <option value="Conciliated by Pangkat">Conciliation</option>
                        <option value="settled">Settled</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6">
        <div class="flex flex-wrap gap-3">
            <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.lupon-case-modal' })" class="h-10">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <span class="hidden sm:inline">New Case</span>
                <span class="inline sm:hidden">New</span>
            </x-primary-button>
            <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.show.lupon-event-tracking-modal' })" class="h-10">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span class="hidden sm:inline">Events</span>
                <span class="inline sm:hidden">Events</span>
            </x-primary-button>
        </div>
    </div>

    <!-- Desktop Table View -->
    <div class="hidden md:block overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-900">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Case No.</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Closed</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($luponCases as $luponCase)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors cursor-pointer"
                        wire:click="$dispatch('openModal', { component: 'modals.show.luponCase-modal', arguments: { luponCase: {{ $luponCase }} }})">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                            {{ $luponCase->case_no }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            {{ \Carbon\Carbon::parse($luponCase->date)->format('M j, Y') }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                            <div class="max-w-xs truncate" title="{{ $luponCase->title }}">
                                {{ $luponCase->title }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                                    'settled' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                    'mediation' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
                                    'dismissed' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200',
                                    'unsolved' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                                    'rejected' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                                    'withdrawn' => 'bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200',
                                    'solved' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                ];
                                $statusColor = $statusColors[strtolower($luponCase->status)] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200';
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
                                {{ ucfirst($luponCase->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                            @if ($luponCase->end)
                                {{ \Carbon\Carbon::parse($luponCase->end)->format('M j, Y') }}
                            @else
                                <span class="text-gray-400 dark:text-gray-500">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
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
                                            wire:click.stop="$dispatch('openModal', { component: 'modals.show.luponCase-modal', arguments: { luponCase: {{ $luponCase }} }})"
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                            View Details
                                        </button>
                                        <button 
                                            wire:click.stop="$dispatch('openModal', { component: 'modals.lupon-case-complainant-modal', arguments: { 'lupon_case_id': {{ $luponCase->id }} }})"
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                            Add Complainant
                                        </button>
                                        <button 
                                            wire:click.stop="$dispatch('openModal', { component: 'modals.lupon-case-respondent-modal', arguments: { lupon_case_id: {{ $luponCase->id }} }})"
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                            Add Respondent
                                        </button>
                                        <button 
                                            wire:click.stop="$dispatch('openModal', { component: 'modals.lupon-summon-tracking-modal', arguments: { lupon_case_id: {{ $luponCase->id }} }})"
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                            Add Summon
                                        </button>
                                        <button 
                                            wire:click.stop="$dispatch('openModal', { component: 'modals.lupon-hearing-tracking-modal', arguments: { lupon_case_id: {{ $luponCase->id }} }})"
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                            Add Hearing
                                        </button>
                                        <button 
                                            wire:click.stop="$dispatch('openModal', { component: 'modals.luponCase-modal', arguments: { luponCase: {{ $luponCase->id }} }})"
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                            Edit
                                        </button>
                                        <button 
                                            x-data
                                            @click.stop="if (confirm('Are you sure you want to delete this case?')) { $wire.call('delete', {{ $luponCase->id }}) }"
                                            class="block w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                            No cases found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Mobile Card View -->
    <div class="md:hidden space-y-4">
        @forelse($luponCases as $luponCase)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="p-4 relative">
                <div class="flex items-start justify-between gap-3">
                    <div class="flex-1 min-w-0 cursor-pointer" wire:click="$dispatch('openModal', { component: 'modals.show.luponCase-modal', arguments: { luponCase: {{ $luponCase }} }})">
                        <div class="flex items-center gap-2 mb-2">
                            <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100">
                                {{ $luponCase->case_no }}
                            </h3>
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                                    'settled' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                    'mediation' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
                                    'dismissed' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200',
                                    'unsolved' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                                    'rejected' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                                    'withdrawn' => 'bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200',
                                    'solved' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                ];
                                $statusColor = $statusColors[strtolower($luponCase->status)] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200';
                            @endphp
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
                                {{ ucfirst($luponCase->status) }}
                            </span>
                        </div>
                        <p class="text-sm text-gray-900 dark:text-gray-100 mb-2 line-clamp-2">{{ $luponCase->title }}</p>
                        <div class="space-y-1 text-sm text-gray-500 dark:text-gray-400">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                </svg>
                                <span>Date: {{ \Carbon\Carbon::parse($luponCase->date)->format('M j, Y') }}</span>
                            </div>
                            @if ($luponCase->end)
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span>Closed: {{ \Carbon\Carbon::parse($luponCase->end)->format('M j, Y') }}</span>
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
                                    wire:click.stop="$dispatch('openModal', { component: 'modals.show.luponCase-modal', arguments: { luponCase: {{ $luponCase }} }})"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    View Details
                                </button>
                                <button 
                                    wire:click.stop="$dispatch('openModal', { component: 'modals.lupon-case-complainant-modal', arguments: { 'lupon_case_id': {{ $luponCase->id }} }})"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Add Complainant
                                </button>
                                <button 
                                    wire:click.stop="$dispatch('openModal', { component: 'modals.lupon-case-respondent-modal', arguments: { lupon_case_id: {{ $luponCase->id }} }})"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Add Respondent
                                </button>
                                <button 
                                    wire:click.stop="$dispatch('openModal', { component: 'modals.lupon-summon-tracking-modal', arguments: { lupon_case_id: {{ $luponCase->id }} }})"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Add Summon
                                </button>
                                <button 
                                    wire:click.stop="$dispatch('openModal', { component: 'modals.lupon-hearing-tracking-modal', arguments: { lupon_case_id: {{ $luponCase->id }} }})"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Add Hearing
                                </button>
                                <button 
                                    wire:click.stop="$dispatch('openModal', { component: 'modals.luponCase-modal', arguments: { luponCase: {{ $luponCase->id }} }})"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Edit
                                </button>
                                <button 
                                    @click.stop="if (confirm('Are you sure you want to delete this case?')) { $wire.call('delete', {{ $luponCase->id }}) }"
                                    class="block w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 p-6 text-center">
            <p class="text-gray-500 dark:text-gray-400">No cases found.</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $luponCases->links() }}
    </div>

    <script>
        let casesChart = null;

        function initChart(data) {
            const ctx = document.getElementById('casesChart').getContext('2d');

            if (casesChart) {
                casesChart.destroy();
            }

            casesChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels.map(date => {
                        const [year, month] = date.split('-');
                        return new Date(year, month - 1).toLocaleString('en-US', { month: 'short' });
                    }),
                    datasets: [
                        {
                            label: 'Cases Filed',
                            data: data.total_cases,
                            backgroundColor: 'rgba(99, 102, 241, 0.6)',
                            borderColor: 'rgba(99, 102, 241, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Unsolved Cases',
                            data: data.unsolved_cases,
                            backgroundColor: 'rgba(239, 68, 68, 0.6)',
                            borderColor: 'rgba(239, 68, 68, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    }
                }
            });
        }

        // Listen for the Livewire event directly
        window.addEventListener('updateChart', event => {
            initChart(event.detail.chartData);
        });
    </script>
</div>
