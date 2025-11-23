<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Disaster Monitoring Dashboard</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Real-time monitoring of active disasters</p>
        </div>
        <div class="flex gap-2">
            <x-secondary-button href="{{ route('disaster-rss') }}" target="_blank">
                <i class="fas fa-rss mr-2"></i> RSS Feed
            </x-secondary-button>
            <x-primary-button href="{{ route('disaster-management') }}" wire:navigate>
                <i class="fas fa-list mr-2"></i> All Events
            </x-primary-button>
        </div>
    </div>

    <!-- Active Events -->
    <div class="mb-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Active Disaster Events</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse($activeEvents as $event)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 @if($event->severity === 'critical') border-red-500 @elseif($event->severity === 'high') border-orange-500 @elseif($event->severity === 'medium') border-yellow-500 @else border-blue-500 @endif">
                    <div class="flex justify-between items-start mb-2">
                        <h4 class="font-semibold text-gray-900 dark:text-gray-100">{{ $event->title }}</h4>
                        <span class="text-xs px-2 py-1 rounded @if($event->severity === 'critical') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 @elseif($event->severity === 'high') bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200 @elseif($event->severity === 'medium') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 @else bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 @endif">
                            {{ ucfirst($event->severity) }}
                        </span>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ $event->disasterType->name }}</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Started: {{ $event->start_date->format('M d, Y H:i') }}</p>
                    @if($event->location)
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">📍 {{ $event->location }}</p>
                    @endif
                    <div class="mt-3">
                        <button wire:click="selectEvent({{ $event->id }})" class="text-sm text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                            View Details →
                        </button>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-8 bg-gray-50 dark:bg-gray-900/50 rounded-lg">
                    <i class="fas fa-check-circle text-gray-400 text-4xl mb-3"></i>
                    <p class="text-gray-500 dark:text-gray-400">No active disaster events</p>
                </div>
            @endforelse
        </div>
    </div>

    @if($selectedEvent)
        <!-- Selected Event Details -->
        <div class="mb-6 bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100">{{ $selectedEvent->title }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $selectedEvent->disasterType->name }} • {{ $selectedEvent->start_date->format('M d, Y H:i') }}</p>
                </div>
                <button wire:click="clearSelection" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            @if($selectedEvent->description)
                <p class="text-gray-700 dark:text-gray-300 mb-4">{{ $selectedEvent->description }}</p>
            @endif

            <!-- Recent Alerts -->
            @if($selectedEvent->alerts->count() > 0)
                <div class="mb-4">
                    <h4 class="font-semibold text-gray-900 dark:text-gray-100 mb-2">Recent Alerts</h4>
                    <div class="space-y-2">
                        @foreach($selectedEvent->alerts->take(3) as $alert)
                            <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded p-3">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-medium text-yellow-900 dark:text-yellow-100">{{ $alert->title }}</p>
                                        <p class="text-sm text-yellow-700 dark:text-yellow-300 mt-1">{{ Str::limit($alert->message, 100) }}</p>
                                        <p class="text-xs text-yellow-600 dark:text-yellow-400 mt-1">Issued: {{ $alert->issued_at->format('M d, Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Recent Monitoring Logs -->
            @if($selectedEvent->monitoringLogs->count() > 0)
                <div>
                    <h4 class="font-semibold text-gray-900 dark:text-gray-100 mb-2">Recent Updates</h4>
                    <div class="space-y-2">
                        @foreach($selectedEvent->monitoringLogs->take(5) as $log)
                            <div class="border-l-4 border-indigo-500 pl-4 py-2">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-gray-100">{{ $log->title }}</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ Str::limit($log->description, 150) }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                            {{ ucfirst(str_replace('_', ' ', $log->log_type)) }} • {{ $log->logged_at->format('M d, Y H:i') }} by {{ $log->loggedBy->name }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    @endif

    <!-- Recent Alerts -->
    <div class="mb-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Recent Alerts</h3>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($recentAlerts as $alert)
                    <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="text-xs px-2 py-1 rounded @if($alert->severity === 'critical') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 @elseif($alert->severity === 'high') bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200 @elseif($alert->severity === 'medium') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 @else bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 @endif">
                                        {{ ucfirst($alert->alert_type) }}
                                    </span>
                                    <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $alert->title }}</span>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ Str::limit($alert->message, 100) }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    Issued: {{ $alert->issued_at->format('M d, Y H:i') }} by {{ $alert->issuedBy->name }}
                                    @if($alert->disasterEvent)
                                        • Event: {{ $alert->disasterEvent->title }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-sm text-gray-500 dark:text-gray-400">No recent alerts</div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Recent Monitoring Logs -->
    <div>
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Recent Monitoring Updates</h3>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($recentLogs as $log)
                    <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="text-xs px-2 py-1 rounded bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                                        {{ ucfirst(str_replace('_', ' ', $log->log_type)) }}
                                    </span>
                                    <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $log->title }}</span>
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ Str::limit($log->description, 150) }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    {{ $log->logged_at->format('M d, Y H:i') }} by {{ $log->loggedBy->name }}
                                    @if($log->disasterEvent)
                                        • Event: {{ $log->disasterEvent->title }}
                                    @endif
                                    @if($log->location)
                                        • Location: {{ $log->location }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-sm text-gray-500 dark:text-gray-400">No recent monitoring updates</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

