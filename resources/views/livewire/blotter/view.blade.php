<div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-h-[90vh] overflow-y-auto">
    <!-- Sticky Header -->
    <div class="sticky top-0 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-4 sm:px-6 py-4 flex items-start justify-between z-10">
        <div class="flex-1 pr-4">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-gray-100 leading-tight">
                Blotter Details
            </h2>
            <div class="mt-2 flex flex-wrap items-center gap-2">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                    Blotter Report
                </span>
            </div>
        </div>
        <button 
            wire:click="closeModal"
            class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500 flex-shrink-0"
            title="Close">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Content -->
    <div class="px-4 sm:px-6 py-5 sm:py-6 space-y-6">
        <!-- Incident Details Section -->
        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>
                Incident Details
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Date of Incident</p>
                    <p class="text-base text-gray-900 dark:text-gray-100">{{ \Carbon\Carbon::parse($blotter->incident)->format('F j, Y g:i A') }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Date Reported</p>
                    <p class="text-base text-gray-900 dark:text-gray-100">{{ \Carbon\Carbon::parse($blotter->reported)->format('F j, Y g:i A') }}</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Place of Incident</p>
                    <p class="text-base text-gray-900 dark:text-gray-100">{{ $blotter->place ?? 'Not specified' }}</p>
                </div>
            </div>
        </div>

        <!-- Narration Section -->
        @if($blotter->narration)
        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
                Narration
            </h3>
            <div class="prose prose-sm sm:prose-base max-w-none dark:prose-invert">
                <p class="text-gray-900 dark:text-gray-100 leading-relaxed whitespace-pre-wrap">{{ $blotter->narration }}</p>
            </div>
        </div>
        @endif

        <!-- Complainant Information Section -->
        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
                Complainant Information
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Full Name</p>
                    <p class="text-base text-gray-900 dark:text-gray-100">{{ trim("{$blotter->firstname} {$blotter->middle} {$blotter->lastname}") }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Contact Number</p>
                    <p class="text-base text-gray-900 dark:text-gray-100">{{ $blotter->contact ?? 'Not provided' }}</p>
                </div>
                <div class="md:col-span-2">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Address</p>
                    <p class="text-base text-gray-900 dark:text-gray-100">{{ $blotter->address ?? 'Not provided' }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Civil Status</p>
                    <p class="text-base text-gray-900 dark:text-gray-100">{{ $blotter->civil ?? 'Not provided' }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Date of Birth</p>
                    <p class="text-base text-gray-900 dark:text-gray-100">
                        @if($blotter->date_of_birth)
                            {{ \Carbon\Carbon::parse($blotter->date_of_birth)->format('F j, Y') }}
                        @else
                            Not provided
                        @endif
                    </p>
                </div>
                @if($blotter->place_of_birth)
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Place of Birth</p>
                    <p class="text-base text-gray-900 dark:text-gray-100">{{ $blotter->place_of_birth }}</p>
                </div>
                @endif
                @if($blotter->occupation)
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Occupation</p>
                    <p class="text-base text-gray-900 dark:text-gray-100">{{ $blotter->occupation }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Complainee Information Section -->
        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
                Complainee Information
            </h3>
            @if($blotter->complainee)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Full Name</p>
                        <p class="text-base text-gray-900 dark:text-gray-100">{{ trim("{$blotter->complainee->first} {$blotter->complainee->middle} {$blotter->complainee->last}") }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Contact Number</p>
                        <p class="text-base text-gray-900 dark:text-gray-100">{{ $blotter->complainee->contact ?? 'Not provided' }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Address</p>
                        <p class="text-base text-gray-900 dark:text-gray-100">{{ $blotter->complainee->address ?? 'Not provided' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Civil Status</p>
                        <p class="text-base text-gray-900 dark:text-gray-100">{{ $blotter->complainee->civil_status ?? 'Not provided' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Date of Birth</p>
                        <p class="text-base text-gray-900 dark:text-gray-100">
                            @if($blotter->complainee->date_of_birth)
                                {{ \Carbon\Carbon::parse($blotter->complainee->date_of_birth)->format('F j, Y') }}
                            @else
                                Not provided
                            @endif
                        </p>
                    </div>
                    @if($blotter->complainee->place_of_birth)
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Place of Birth</p>
                        <p class="text-base text-gray-900 dark:text-gray-100">{{ $blotter->complainee->place_of_birth }}</p>
                    </div>
                    @endif
                    @if($blotter->complainee->occupation)
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Occupation</p>
                        <p class="text-base text-gray-900 dark:text-gray-100">{{ $blotter->complainee->occupation }}</p>
                    </div>
                    @endif
                    @if($blotter->complainee->influence)
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Influence</p>
                        <p class="text-base text-gray-900 dark:text-gray-100">{{ $blotter->complainee->influence }}</p>
                    </div>
                    @endif
                </div>
            @else
                <div class="text-center py-8">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mx-auto text-gray-400 dark:text-gray-500 mb-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">No complainee assigned yet.</p>
                </div>
            @endif
        </div>

        <!-- Recorded By Section -->
        @if($blotter->user)
        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                </svg>
                Record Information
            </h3>
            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
                <span class="font-medium">Recorded by:</span>
                <span class="text-gray-900 dark:text-gray-100">{{ $blotter->user->name }}</span>
            </div>
        </div>
        @endif
    </div>
</div>
