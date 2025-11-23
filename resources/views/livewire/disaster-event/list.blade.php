<div class="p-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Disaster Events</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Manage and monitor disaster events</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <x-secondary-button href="{{ route('disaster-management') }}" wire:navigate>
                <i class="fas fa-home mr-2"></i> Dashboard
            </x-secondary-button>
            <x-secondary-button href="{{ route('disaster-monitoring') }}" wire:navigate>
                <i class="fas fa-chart-line mr-2"></i> Monitoring
            </x-secondary-button>
            <x-secondary-button href="{{ route('disaster-alert') }}" wire:navigate>
                <i class="fas fa-bell mr-2"></i> Alerts
            </x-secondary-button>
            <x-secondary-button href="{{ route('preparedness-checklist') }}" wire:navigate>
                <i class="fas fa-clipboard-check mr-2"></i> Checklists
            </x-secondary-button>
            <x-secondary-button href="{{ route('disaster-type') }}" wire:navigate>
                <i class="fas fa-tags mr-2"></i> Types
            </x-secondary-button>
            <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.disaster-event-modal' })">
                <i class="fas fa-plus mr-2"></i> New Event
            </x-primary-button>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <x-input-label for="search" value="Search" />
                <x-text-input wire:model.debounce.500ms="search" id="search" class="mt-1 block w-full" placeholder="Search events..." />
            </div>
            <div>
                <x-input-label for="statusFilter" value="Status" />
                <select wire:model.live="statusFilter" id="statusFilter" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="">All Status</option>
                    <option value="draft">Draft</option>
                    <option value="active">Active</option>
                    <option value="resolved">Resolved</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
            <div>
                <x-input-label for="severityFilter" value="Severity" />
                <select wire:model.live="severityFilter" id="severityFilter" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="">All Severity</option>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                    <option value="critical">Critical</option>
                </select>
            </div>
            <div>
                <x-input-label for="typeFilter" value="Disaster Type" />
                <select wire:model.live="typeFilter" id="typeFilter" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="">All Types</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @if($search || $statusFilter || $severityFilter || $typeFilter)
            <div class="mt-4">
                <x-secondary-button wire:click="resetFilters" size="sm">Clear Filters</x-secondary-button>
            </div>
        @endif
    </div>

    <!-- Events List -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-900">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Event</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Severity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Start Date</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($events as $event)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button 
                                    wire:click="$dispatch('openModal', { component: 'modals.disaster-event-view-modal', arguments: { event: {{ $event->id }} } })"
                                    class="text-sm font-medium text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 hover:underline"
                                >
                                    {{ $event->title }}
                                </button>
                                @if($event->location)
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $event->location }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-gray-100">{{ $event->disasterType->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($event->status === 'active')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                        Active
                                    </span>
                                @elseif($event->status === 'resolved')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        Resolved
                                    </span>
                                @elseif($event->status === 'cancelled')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                        Cancelled
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                        Draft
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($event->severity === 'critical')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                        Critical
                                    </span>
                                @elseif($event->severity === 'high')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200">
                                        High
                                    </span>
                                @elseif($event->severity === 'medium')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                        Medium
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                        Low
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-gray-100">{{ $event->start_date->format('M d, Y H:i') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button wire:click="$dispatch('openModal', { component: 'modals.disaster-event-view-modal', arguments: { event: {{ $event->id }} } })" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 mr-3">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button wire:click="$dispatch('openModal', { component: 'modals.disaster-event-modal', arguments: { event: {{ $event->id }} } })" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">
                                No disaster events found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
            {{ $events->links() }}
        </div>
    </div>
</div>

