<div class="space-y-6">
    <!-- Top Section: Statistics and Announcements Side by Side -->
    <div class="grid grid-cols-1 lg:grid-cols-[1fr_1fr] gap-6">
        <!-- Left Column: Statistics Cards -->
        <div class="space-y-6">
            <!-- Statistics Cards Section -->
            @hasanyrole('support|superadmin|administrator')
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                <!-- Pending Complaints Card -->
                <a href="{{ route('complaint') }}" class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-red-50 to-red-100 dark:from-red-900/20 dark:to-red-800/20 p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-red-200 dark:border-red-800/50">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-red-600 dark:text-red-400 mb-1">Pending Complaints</p>
                            <p class="text-3xl font-bold text-red-700 dark:text-red-300">{{ $pending_complaints }}</p>
                        </div>
                        <div class="flex-shrink-0 p-3 bg-red-500/10 rounded-lg group-hover:bg-red-500/20 transition-colors">
                            <svg class="w-8 h-8 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Pending Clearances Card -->
                <a href="{{ route('clearance') }}" class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-indigo-50 to-indigo-100 dark:from-indigo-900/20 dark:to-indigo-800/20 p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-indigo-200 dark:border-indigo-800/50">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-indigo-600 dark:text-indigo-400 mb-1">Pending Clearances</p>
                            <p class="text-3xl font-bold text-indigo-700 dark:text-indigo-300">{{ $pending_clearances }}</p>
                        </div>
                        <div class="flex-shrink-0 p-3 bg-indigo-500/10 rounded-lg group-hover:bg-indigo-500/20 transition-colors">
                            <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Total Users and Pending Tasks Cards (Admin and Support) -->
            @hasanyrole('superadmin|administrator|support')
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                <!-- Total Users Card -->
                <a href="{{ route('user-management') }}" class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-blue-200 dark:border-blue-800/50">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-blue-600 dark:text-blue-400 mb-1">Total Users</p>
                            <p class="text-3xl font-bold text-blue-700 dark:text-blue-300">{{ $total_users }}</p>
                        </div>
                        <div class="flex-shrink-0 p-3 bg-blue-500/10 rounded-lg group-hover:bg-blue-500/20 transition-colors">
                            <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                </a>

                <!-- Pending Tasks Card -->
                <a href="{{ route('todo') }}" class="group relative overflow-hidden rounded-xl bg-gradient-to-br from-amber-50 to-amber-100 dark:from-amber-900/20 dark:to-amber-800/20 p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-amber-200 dark:border-amber-800/50">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-amber-600 dark:text-amber-400 mb-1">Pending Tasks</p>
                            <p class="text-3xl font-bold text-amber-700 dark:text-amber-300">{{ $pending_tasks }}</p>
                        </div>
                        <div class="flex-shrink-0 p-3 bg-amber-500/10 rounded-lg group-hover:bg-amber-500/20 transition-colors">
                            <svg class="w-8 h-8 text-amber-600 dark:text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                        </div>
                    </div>
                </a>
            </div>
            @endhasanyrole
            @endhasanyrole

            <!-- Latest Scheduled Activities Panel (Admin and Support) -->
            @hasanyrole('superadmin|administrator|support')
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="px-4 sm:px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">Latest Scheduled Activities</h2>
                </div>
                <div class="p-4 sm:p-6">
                    @forelse($latest_scheduled_activities as $activity)
                    <div class="flex items-start gap-4 py-3 border-b border-gray-200 dark:border-gray-700 last:border-b-0">
                        <div class="flex-shrink-0 p-2 bg-blue-100 dark:bg-blue-900/20 rounded-lg">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-900 dark:text-gray-100 mb-1">{{ $activity->title }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ \Carbon\Carbon::parse($activity->start)->format('M d, Y') }}
                            </p>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <p class="text-gray-500 dark:text-gray-400">No scheduled activities found</p>
                    </div>
                    @endforelse
                </div>
            </div>
            @endhasanyrole

            <!-- User Statistics Section (Admin and Support) -->
            @hasanyrole('superadmin|administrator|support')
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="px-4 sm:px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">User Statistics</h2>
                </div>
                <div class="p-4 sm:p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4">
                        <!-- Out of School Youth -->
                        <a href="{{ route('settings') }}" class="group relative overflow-hidden rounded-lg bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 p-5 shadow-md hover:shadow-lg transition-all duration-300 border border-purple-200 dark:border-purple-800/50">
                            <div class="relative z-10">
                                <p class="text-sm font-semibold text-purple-700 dark:text-purple-300 mb-2">Out of School Youth</p>
                                <p class="text-2xl font-bold text-purple-900 dark:text-purple-100">{{ $total_out_of_school_youth['total'] ?? 0 }}</p>
                            </div>
                            <div class="absolute bottom-0 right-0 opacity-10 group-hover:opacity-20 transition-opacity">
                                <svg class="w-20 h-20 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path>
                                </svg>
                            </div>
                        </a>

                        <!-- Malnourished Children -->
                        <a href="{{ route('settings') }}" class="group relative overflow-hidden rounded-lg bg-gradient-to-br from-orange-50 to-orange-100 dark:from-orange-900/20 dark:to-orange-800/20 p-5 shadow-md hover:shadow-lg transition-all duration-300 border border-orange-200 dark:border-orange-800/50">
                            <div class="relative z-10">
                                <p class="text-sm font-semibold text-orange-700 dark:text-orange-300 mb-2">Malnourished Children</p>
                                <p class="text-2xl font-bold text-orange-900 dark:text-orange-100">{{ $total_malnourished_children['total'] ?? 0 }}</p>
                            </div>
                            <div class="absolute bottom-0 right-0 opacity-10 group-hover:opacity-20 transition-opacity">
                                <svg class="w-20 h-20 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </a>

                        <!-- Senior Citizens -->
                        <a href="{{ route('settings') }}" class="group relative overflow-hidden rounded-lg bg-gradient-to-br from-cyan-50 to-cyan-100 dark:from-cyan-900/20 dark:to-cyan-800/20 p-5 shadow-md hover:shadow-lg transition-all duration-300 border border-cyan-200 dark:border-cyan-800/50">
                            <div class="relative z-10">
                                <p class="text-sm font-semibold text-cyan-700 dark:text-cyan-300 mb-2">Senior Citizens</p>
                                <p class="text-2xl font-bold text-cyan-900 dark:text-cyan-100">{{ $total_senior_citizens['total'] ?? 0 }}</p>
                            </div>
                            <div class="absolute bottom-0 right-0 opacity-10 group-hover:opacity-20 transition-opacity">
                                <svg class="w-20 h-20 text-cyan-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </a>

                        <!-- Pregnant -->
                        <a href="{{ route('settings') }}" class="group relative overflow-hidden rounded-lg bg-gradient-to-br from-pink-50 to-pink-100 dark:from-pink-900/20 dark:to-pink-800/20 p-5 shadow-md hover:shadow-lg transition-all duration-300 border border-pink-200 dark:border-pink-800/50">
                            <div class="relative z-10">
                                <p class="text-sm font-semibold text-pink-700 dark:text-pink-300 mb-2">Pregnant</p>
                                <p class="text-2xl font-bold text-pink-900 dark:text-pink-100">{{ $total_pregnant['total'] ?? 0 }}</p>
                            </div>
                            <div class="absolute bottom-0 right-0 opacity-10 group-hover:opacity-20 transition-opacity">
                                <svg class="w-20 h-20 text-pink-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </a>

                        <!-- Single Parents -->
                        <a href="{{ route('settings') }}" class="group relative overflow-hidden rounded-lg bg-gradient-to-br from-teal-50 to-teal-100 dark:from-teal-900/20 dark:to-teal-800/20 p-5 shadow-md hover:shadow-lg transition-all duration-300 border border-teal-200 dark:border-teal-800/50">
                            <div class="relative z-10">
                                <p class="text-sm font-semibold text-teal-700 dark:text-teal-300 mb-2">Single Parents</p>
                                <p class="text-2xl font-bold text-teal-900 dark:text-teal-100">{{ $total_single_parents['total'] ?? 0 }}</p>
                            </div>
                            <div class="absolute bottom-0 right-0 opacity-10 group-hover:opacity-20 transition-opacity">
                                <svg class="w-20 h-20 text-teal-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            @endhasanyrole
        </div>

        <!-- Right Column - Announcements (Prominent) -->
        <div class="lg:sticky lg:top-6 space-y-6 h-fit">
            <!-- Announcements Section - Full Height -->
            <div class="bg-gradient-to-br from-red-50 via-red-50 to-red-100 dark:from-red-900/30 dark:via-red-900/20 dark:to-red-800/30 rounded-xl shadow-xl border-2 border-red-200 dark:border-red-800 overflow-hidden">
                <!-- Header -->
                <div class="px-4 sm:px-6 py-4 bg-gradient-to-r from-red-500 to-red-600 dark:from-red-700 dark:to-red-800 border-b-2 border-red-400 dark:border-red-900">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-white/20 rounded-lg">
                                <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                                </svg>
                            </div>
                            <h2 class="text-2xl font-bold text-white">Announcements</h2>
                        </div>
                        <a href="{{ route('announcement') }}" class="text-sm text-white/90 hover:text-white font-medium underline underline-offset-2">
                            View All →
                        </a>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-4 sm:p-6 space-y-6">
                    <!-- Pinned Announcement (Featured) -->
                    @if($pinned_announcement)
                    <div class="relative overflow-hidden rounded-xl bg-gradient-to-br from-yellow-50 to-yellow-100 dark:from-yellow-900/30 dark:to-yellow-800/30 border-2 border-yellow-400 dark:border-yellow-700 shadow-lg">
                        <div class="absolute top-0 right-0 px-3 py-1 bg-yellow-400 dark:bg-yellow-600 text-yellow-900 dark:text-yellow-100 text-xs font-bold rounded-bl-lg">
                            PINNED
                        </div>
                        <a href="#" wire:click="$dispatch('openModal', { component: 'modals.show.announcement-modal', arguments: { announcement: {{ $pinned_announcement }} }})" class="block p-5 sm:p-6 hover:bg-yellow-100/50 dark:hover:bg-yellow-900/20 transition-colors">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 p-4 bg-white dark:bg-gray-800 rounded-xl shadow-md">
                                    <div class="text-3xl">{!! $pinned_announcement->category->icon !!}</div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="px-2 py-1 bg-yellow-200 dark:bg-yellow-800 text-yellow-800 dark:text-yellow-200 text-xs font-semibold rounded">
                                            {{ $pinned_announcement->category->name }}
                                        </span>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2 leading-tight">{{ $pinned_announcement->title }}</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ $pinned_announcement->created_at->format('F j, Y') }}
                                    </p>
                                    <p class="text-base text-gray-700 dark:text-gray-300 line-clamp-4 leading-relaxed">{!! $pinned_announcement->excerpt(200) !!}</p>
                                    <div class="mt-4 flex items-center text-red-600 dark:text-red-400 font-medium text-sm">
                                        Read More
                                        <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif

                    <!-- Other Announcements -->
                    @forelse($announcements as $announcement)
                    <a href="#" wire:click="$dispatch('openModal', { component: 'modals.show.announcement-modal', arguments: { announcement: {{ $announcement }} }})" class="block group rounded-xl bg-white dark:bg-gray-800 p-5 sm:p-6 hover:bg-red-50 dark:hover:bg-red-900/10 transition-all duration-300 border-2 border-gray-200 dark:border-gray-700 hover:border-red-300 dark:hover:border-red-700 shadow-md hover:shadow-lg">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 p-3 bg-red-100 dark:bg-red-900/30 rounded-xl group-hover:bg-red-200 dark:group-hover:bg-red-900/40 transition-colors shadow-sm">
                                <div class="text-2xl">{!! $announcement->category->icon !!}</div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="px-2 py-1 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 text-xs font-semibold rounded">
                                        {{ $announcement->category->name }}
                                    </span>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-2 leading-tight group-hover:text-red-700 dark:group-hover:text-red-400 transition-colors">{{ $announcement->title }}</h3>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mb-3 flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $announcement->created_at->format('M j, Y') }}
                                </p>
                                <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-3 leading-relaxed">{!! $announcement->excerpt() !!}</p>
                                <div class="mt-3 flex items-center text-red-600 dark:text-red-400 font-medium text-sm opacity-0 group-hover:opacity-100 transition-opacity">
                                    Read More
                                    <svg class="w-4 h-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                    @empty
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-gray-400 dark:text-gray-600 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                        </svg>
                        <p class="text-gray-500 dark:text-gray-400 font-medium">No announcements found</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Section: Tasks, Complaints, Activities -->
    <div class="space-y-6">
            <!-- Pending Tasks Section -->
            @unlessrole('user|anonymous')
            @if($todos->isNotEmpty())
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="px-4 sm:px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">Pending Tasks</h2>
                    <a href="{{ route('todo') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 font-medium">
                        View All →
                    </a>
                </div>
                <div class="p-4 sm:p-6 space-y-4">
                    @foreach($todos as $todo)
                    <a href="{{ route('todo') }}" class="block group rounded-lg bg-gray-50 dark:bg-gray-900/50 p-4 hover:bg-gray-100 dark:hover:bg-gray-900 transition-colors border border-gray-200 dark:border-gray-700">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 p-2 bg-indigo-100 dark:bg-indigo-900/20 rounded-lg group-hover:bg-indigo-200 dark:group-hover:bg-indigo-900/30 transition-colors">
                                <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100 mb-1">{{ $todo->task }}</h3>
                                @if($todo->due_date)
                                <p class="text-sm text-gray-500 dark:text-gray-400 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Due: {{ $todo->due_date->format('M d, Y') }}
                                </p>
                                @endif
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
            @endunlessrole

            <!-- User Complaints Section -->
            @hasanyrole('user')
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="px-4 sm:px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">My Complaints</h2>
                    <a href="{{ route('complaint') }}" class="text-sm text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 font-medium">
                        View All →
                    </a>
                </div>
                <div class="p-4 sm:p-6 space-y-4">
                    @forelse($complaints as $complaint)
                    <a href="{{ route('complaint') }}" class="block group rounded-lg bg-gray-50 dark:bg-gray-900/50 p-4 hover:bg-gray-100 dark:hover:bg-gray-900 transition-colors border border-gray-200 dark:border-gray-700">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 p-2 bg-red-100 dark:bg-red-900/20 rounded-lg group-hover:bg-red-200 dark:group-hover:bg-red-900/30 transition-colors">
                                <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100 mb-1">{{ $complaint->title }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">{!! $complaint->excerpt() !!}</p>
                            </div>
                        </div>
                    </a>
                    @empty
                    <div class="text-center py-8">
                        <p class="text-gray-500 dark:text-gray-400">No complaints found</p>
                    </div>
                    @endforelse
                </div>
            </div>
            @endhasanyrole

            <!-- Today's Activities Section -->
            @unlessrole('user|anonymous')
            @if($activities->isNotEmpty())
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="px-4 sm:px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100">Today's Activities</h2>
                </div>
                <div class="p-4 sm:p-6 space-y-4">
                    @foreach($activities as $activity)
                    <div class="rounded-lg bg-gray-50 dark:bg-gray-900/50 p-4 border border-gray-200 dark:border-gray-700">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 p-2 bg-blue-100 dark:bg-blue-900/20 rounded-lg">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-base font-semibold text-gray-900 dark:text-gray-100 mb-1">{{ $activity->title }}</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $activity->description }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            @endunlessrole
    </div>
</div>
