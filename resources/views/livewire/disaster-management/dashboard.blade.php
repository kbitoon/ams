<div class="p-6">
    <!-- Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Disaster Management System</h2>
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Comprehensive disaster preparedness, response, monitoring, and recovery management</p>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-red-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Active Events</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $activeEventsCount }}</p>
                </div>
                <i class="fas fa-exclamation-triangle text-3xl text-red-500"></i>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Active Alerts</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $activeAlertsCount }}</p>
                </div>
                <i class="fas fa-bell text-3xl text-yellow-500"></i>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Preparedness Checklists</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $checklistsCount }}</p>
                </div>
                <i class="fas fa-clipboard-check text-3xl text-blue-500"></i>
            </div>
        </div>
    </div>

    <!-- Module Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Disaster Events -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition-shadow p-6">
            <div class="flex items-center gap-4 mb-4">
                <div class="bg-red-100 dark:bg-red-900/20 rounded-lg p-3">
                    <i class="fas fa-exclamation-triangle text-2xl text-red-600 dark:text-red-400"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Disaster Events</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Manage disaster events</p>
                </div>
            </div>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Create and manage disaster events, track their status and severity.</p>
            <a href="{{ route('disaster-management') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium">
                Go to Events <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>

        <!-- Preparedness -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition-shadow p-6">
            <div class="flex items-center gap-4 mb-4">
                <div class="bg-blue-100 dark:bg-blue-900/20 rounded-lg p-3">
                    <i class="fas fa-clipboard-check text-2xl text-blue-600 dark:text-blue-400"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Preparedness</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Checklists & Plans</p>
                </div>
            </div>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Create preparedness checklists and complete them during disasters.</p>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('preparedness-checklist') }}" class="inline-flex items-center text-sm text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium">
                    Checklists <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>

        <!-- Monitoring -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition-shadow p-6">
            <div class="flex items-center gap-4 mb-4">
                <div class="bg-green-100 dark:bg-green-900/20 rounded-lg p-3">
                    <i class="fas fa-chart-line text-2xl text-green-600 dark:text-green-400"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Monitoring</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Real-time Dashboard</p>
                </div>
            </div>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Monitor active disasters, alerts, and recent updates in real-time.</p>
            <a href="{{ route('disaster-monitoring') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium">
                View Dashboard <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>

        <!-- Alerts -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition-shadow p-6">
            <div class="flex items-center gap-4 mb-4">
                <div class="bg-yellow-100 dark:bg-yellow-900/20 rounded-lg p-3">
                    <i class="fas fa-bell text-2xl text-yellow-600 dark:text-yellow-400"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Alerts & Warnings</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Issue alerts</p>
                </div>
            </div>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Issue and manage disaster alerts, warnings, and advisories.</p>
            <a href="{{ route('disaster-alert') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium">
                Manage Alerts <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>

        <!-- Disaster Types -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition-shadow p-6">
            <div class="flex items-center gap-4 mb-4">
                <div class="bg-purple-100 dark:bg-purple-900/20 rounded-lg p-3">
                    <i class="fas fa-tags text-2xl text-purple-600 dark:text-purple-400"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Disaster Types</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Manage types</p>
                </div>
            </div>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Define and manage different types of disasters (typhoon, flood, etc.).</p>
            <a href="{{ route('disaster-type') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium">
                Manage Types <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>

        <!-- Response Teams -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition-shadow p-6">
            <div class="flex items-center gap-4 mb-4">
                <div class="bg-indigo-100 dark:bg-indigo-900/20 rounded-lg p-3">
                    <i class="fas fa-users text-2xl text-indigo-600 dark:text-indigo-400"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Response Teams</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Team management</p>
                </div>
            </div>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Organize and manage disaster response teams and members.</p>
            <a href="{{ route('disaster-response-team') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium">
                Manage Teams <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>

        <!-- Evacuation Centers -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition-shadow p-6">
            <div class="flex items-center gap-4 mb-4">
                <div class="bg-teal-100 dark:bg-teal-900/20 rounded-lg p-3">
                    <i class="fas fa-building text-2xl text-teal-600 dark:text-teal-400"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Evacuation Centers</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Center management</p>
                </div>
            </div>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Manage evacuation centers and their capacity information.</p>
            <a href="{{ route('evacuation-center') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium">
                Manage Centers <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>

        <!-- Resources -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition-shadow p-6">
            <div class="flex items-center gap-4 mb-4">
                <div class="bg-orange-100 dark:bg-orange-900/20 rounded-lg p-3">
                    <i class="fas fa-boxes text-2xl text-orange-600 dark:text-orange-400"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Resources</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Resource inventory</p>
                </div>
            </div>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Track disaster resources, equipment, and supplies.</p>
            <a href="{{ route('disaster-resource') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium">
                Manage Resources <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>

        <!-- Recovery -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition-shadow p-6">
            <div class="flex items-center gap-4 mb-4">
                <div class="bg-emerald-100 dark:bg-emerald-900/20 rounded-lg p-3">
                    <i class="fas fa-tools text-2xl text-emerald-600 dark:text-emerald-400"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Recovery</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Recovery activities</p>
                </div>
            </div>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Plan and track disaster recovery activities and progress.</p>
            <a href="{{ route('disaster-recovery') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium">
                Manage Recovery <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>

        <!-- Reports -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition-shadow p-6">
            <div class="flex items-center gap-4 mb-4">
                <div class="bg-gray-100 dark:bg-gray-700 rounded-lg p-3">
                    <i class="fas fa-file-alt text-2xl text-gray-600 dark:text-gray-400"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Reports</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Generate reports</p>
                </div>
            </div>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Generate comprehensive disaster reports and statistics.</p>
            <a href="{{ route('disaster-report') }}" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium">
                View Reports <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>

        <!-- RSS Feed -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition-shadow p-6">
            <div class="flex items-center gap-4 mb-4">
                <div class="bg-pink-100 dark:bg-pink-900/20 rounded-lg p-3">
                    <i class="fas fa-rss text-2xl text-pink-600 dark:text-pink-400"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">RSS Feed</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Consolidated feed</p>
                </div>
            </div>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Access consolidated RSS feed for all disaster information.</p>
            <a href="{{ route('disaster-rss') }}" target="_blank" class="inline-flex items-center text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium">
                View RSS Feed <i class="fas fa-external-link-alt ml-2"></i>
            </a>
        </div>
    </div>
</div>

