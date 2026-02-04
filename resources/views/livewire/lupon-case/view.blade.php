<div x-data="{ openTab: 1 }" class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-h-[90vh] overflow-y-auto">
    <!-- Sticky Header -->
    <div class="sticky top-0 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-4 sm:px-6 py-4 flex items-start justify-between z-10">
        <div class="flex-1 pr-4">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-gray-100 leading-tight">
                {{ $luponCase->title }}
            </h2>
            <div class="mt-2 flex flex-wrap items-center gap-2">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                    Case #{{ $luponCase->case_no }}
                </span>
                @php
                    $statusColors = [
                        'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                        'settled' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                        'mediation' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
                        'Conciliated by Pangkat' => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200',
                    ];
                    $statusColor = $statusColors[strtolower($luponCase->status)] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200';
                @endphp
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
                    {{ ucfirst($luponCase->status) }}
                </span>
            </div>
        </div>
        <div class="flex items-center gap-2 flex-shrink-0">
            @hasanyrole('superadmin|administrator|lupon')
            <button 
                wire:click.stop="$dispatch('openModal', { component: 'modals.luponCase-modal', arguments: { luponCase: {{ $luponCase->id }} }})"
                class="p-2 text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300 hover:bg-indigo-50 dark:hover:bg-indigo-900/50 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500"
                title="Edit Case">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                </svg>
            </button>
            @endhasanyrole
            <a href="{{ route('lupon-case.download', $luponCase->id) }}" @click.stop
                class="p-2 text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 hover:bg-red-50 dark:hover:bg-red-900/50 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-red-500"
                title="Generate PDF">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
            </a>
            <button 
                wire:click="closeModal"
                class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500"
                title="Close">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Tab Navigation -->
    <div class="border-b border-gray-200 dark:border-gray-700 px-4 sm:px-6">
        <nav class="flex space-x-8" aria-label="Tabs">
            <button 
                @click="openTab = 1"
                :class="openTab === 1 ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300'"
                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                Details
            </button>
            <button 
                @click="openTab = 2"
                :class="openTab === 2 ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300'"
                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                Summon
            </button>
            <button 
                @click="openTab = 3"
                :class="openTab === 3 ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300'"
                class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors">
                Hearing
            </button>
        </nav>
    </div>

    <!-- Tab Contents -->
    <div class="px-4 sm:px-6 py-5 sm:py-6">
        <!-- Details Tab -->
        <div x-show="openTab === 1" x-transition class="space-y-6">
            <!-- Case Information -->
            <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                    Case Information
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @if(!empty($luponCase->blotter_id))
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Blotter ID</p>
                        <p class="text-base text-gray-900 dark:text-gray-100">{{ $luponCase->blotter_id }}</p>
                    </div>
                    @endif
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Date Filed</p>
                        <p class="text-base text-gray-900 dark:text-gray-100">{{ \Carbon\Carbon::parse($luponCase->date)->format('F j, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Nature of Case</p>
                        <p class="text-base text-gray-900 dark:text-gray-100">{{ $luponCase->nature ?? 'Not specified' }}</p>
                    </div>
                    @if ($luponCase->end)
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Date Closed</p>
                        <p class="text-base text-gray-900 dark:text-gray-100">{{ \Carbon\Carbon::parse($luponCase->end)->format('F j, Y') }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Complaint Section -->
            @if($luponCase->complaint)
            <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                    Complaint
                </h3>
                <div class="prose prose-sm sm:prose-base max-w-none dark:prose-invert">
                    <div class="text-gray-900 dark:text-gray-100 leading-relaxed">{!! $luponCase->complaint !!}</div>
                </div>
            </div>
            @endif

            <!-- Prayer Section -->
            @if($luponCase->prayer)
            <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Prayer
                </h3>
                <div class="prose prose-sm sm:prose-base max-w-none dark:prose-invert">
                    <div class="text-gray-900 dark:text-gray-100 leading-relaxed">{!! $luponCase->prayer !!}</div>
                </div>
            </div>
            @endif

            <!-- Complainants Section -->
            @if($luponCase->luponCaseComplainants->isNotEmpty())
            <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    Complainants
                </h3>
                <div class="space-y-4">
                    @foreach($luponCase->luponCaseComplainants as $complainant)
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-200 dark:border-gray-700 flex items-start justify-between gap-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 flex-1 min-w-0">
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Name</p>
                                    <p class="text-base text-gray-900 dark:text-gray-100">
                                        {{ trim("{$complainant->firstname} " . ($complainant->middlename !== 'N/A' ? "{$complainant->middlename} " : '') . "{$complainant->lastname}") }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Contact</p>
                                    <p class="text-base text-gray-900 dark:text-gray-100">{{ $complainant->contact_number ?? 'Not provided' }}</p>
                                </div>
                                <div class="md:col-span-2">
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Address</p>
                                    <p class="text-base text-gray-900 dark:text-gray-100">{{ $complainant->address ?? 'Not provided' }}</p>
                                </div>
                            </div>
                            @hasanyrole('superadmin|administrator|lupon')
                            <button
                                type="button"
                                x-data
                                @click.stop="if (confirm('Remove this complainant?')) { $wire.call('deleteComplainant', {{ $complainant->id }}) }"
                                class="flex-shrink-0 p-2 text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 hover:bg-red-50 dark:hover:bg-red-900/50 rounded-lg transition-colors"
                                title="Delete complainant">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </button>
                            @endhasanyrole
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Respondents Section -->
            @if($luponCase->luponCaseRespondents->isNotEmpty())
            <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    Respondents
                </h3>
                <div class="space-y-4">
                    @foreach($luponCase->luponCaseRespondents as $respondent)
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-200 dark:border-gray-700 flex items-start justify-between gap-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 flex-1 min-w-0">
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Name</p>
                                    <p class="text-base text-gray-900 dark:text-gray-100">
                                        {{ trim("{$respondent->firstname} " . ($respondent->middlename !== 'N/A' ? "{$respondent->middlename} " : '') . "{$respondent->lastname}") }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Contact</p>
                                    <p class="text-base text-gray-900 dark:text-gray-100">{{ $respondent->contact_number ?? 'Not provided' }}</p>
                                </div>
                                <div class="md:col-span-2">
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Address</p>
                                    <p class="text-base text-gray-900 dark:text-gray-100">{{ $respondent->address ?? 'Not provided' }}</p>
                                </div>
                            </div>
                            @hasanyrole('superadmin|administrator|lupon')
                            <button
                                type="button"
                                x-data
                                @click.stop="if (confirm('Remove this respondent?')) { $wire.call('deleteRespondent', {{ $respondent->id }}) }"
                                class="flex-shrink-0 p-2 text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 hover:bg-red-50 dark:hover:bg-red-900/50 rounded-lg transition-colors"
                                title="Delete respondent">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </button>
                            @endhasanyrole
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Resolution Forms Section -->
            @if($luponCase->assets->isNotEmpty())
            <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13" />
                    </svg>
                    Resolution Forms
                </h3>
                <div class="space-y-2">
                    @foreach($luponCase->assets as $resolution_form)
                        <div class="flex items-center justify-between bg-white dark:bg-gray-800 rounded-lg p-3 border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                            <a href="{{ asset('storage/' . $resolution_form->path) }}" target="_blank"
                                class="flex items-center gap-2 text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 flex-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                                <span class="truncate">{{ basename($resolution_form->path) }}</span>
                            </a>
                            <button wire:click="deleteAttachment({{ $resolution_form->id }})"
                                class="ml-2 p-2 text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 hover:bg-red-50 dark:hover:bg-red-900/50 rounded-lg transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Comments Section -->
            <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                    </svg>
                    Comments
                </h3>
                @if($luponCaseComments && $luponCaseComments->isNotEmpty())
                    <div class="space-y-4 mb-4">
                        @foreach($luponCase->luponCaseComments as $luponCaseComment)
                            <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-200 dark:border-gray-700">
                                <div class="flex items-start justify-between mb-2">
                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                        </svg>
                                        <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $luponCaseComment->user->name }}</span>
                                    </div>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $luponCaseComment->created_at->format('M j, Y g:i A') }}
                                    </span>
                                </div>
                                <p class="text-sm text-gray-700 dark:text-gray-300">{{ $luponCaseComment->comment }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 dark:text-gray-400 text-sm mb-4">No comments yet.</p>
                @endif

                @hasanyrole('superadmin|administrator|lupon')
                <form action="{{ route('luponCaseComments.store', ['luponCase' => $luponCase->id]) }}" method="POST" class="mt-4">
                    @csrf
                    <textarea name="luponCaseComment" placeholder="Add a comment..."
                        class="w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:focus:border-indigo-400 dark:focus:ring-indigo-400"
                        rows="3"></textarea>
                    <button type="submit" class="mt-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition-colors">
                        Submit Comment
                    </button>
                </form>
                @endhasanyrole
            </div>
        </div>

        <!-- Summon Tab -->
        <div x-show="openTab === 2" x-transition class="space-y-6">
            <div class="flex flex-wrap justify-center gap-2 mb-4">
                <div x-data="{ open: false, summoned_date: '', date_issued: '' }" x-init="
                    summoned_date = localStorage.getItem('summoned_date') || '';
                    date_issued = localStorage.getItem('date_issued') || '';
                ">
                    <button @click="open = true"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                        Complainant Summon PDF
                    </button>
                    <div x-show="open" style="background: rgba(0,0,0,0.5);"
                        class="fixed inset-0 flex items-center justify-center z-50" @click.away="open = false">
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl w-full max-w-md mx-4">
                            <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">Summon PDF Details</h2>
                            <form @submit.prevent="
                                localStorage.setItem('summoned_date', summoned_date);
                                localStorage.setItem('date_issued', date_issued);
                                open = false;
                                setTimeout(() => {
                                    window.location.href = '{{ route('complainant-summon.download', $luponCase->id) }}?summoned_date=' + summoned_date + '&date_issued=' + date_issued;
                                }, 200);
                            ">
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Summon Date & Time</label>
                                    <input type="datetime-local" x-model="summoned_date" required
                                        class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-3 py-2 rounded-lg focus:ring-2 focus:ring-indigo-500">
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Date Issued</label>
                                    <input type="date" x-model="date_issued" required
                                        class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-3 py-2 rounded-lg focus:ring-2 focus:ring-indigo-500">
                                </div>
                                <div class="flex justify-end gap-2">
                                    <button type="button" @click="open = false"
                                        class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500">Cancel</button>
                                    <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg">Generate PDF</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div x-data="{ open: false, summoned_date: '', date_issued: '' }" x-init="
                    summoned_date = localStorage.getItem('summoned_date') || '';
                    date_issued = localStorage.getItem('date_issued') || '';
                ">
                    <button @click="open = true"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                        Respondent Summon PDF
                    </button>
                    <div x-show="open" style="background: rgba(0,0,0,0.5);"
                        class="fixed inset-0 flex items-center justify-center z-50" @click.away="open = false">
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-xl w-full max-w-md mx-4">
                            <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mb-4">Summon PDF Details</h2>
                            <form @submit.prevent="
                                localStorage.setItem('summoned_date', summoned_date);
                                localStorage.setItem('date_issued', date_issued);
                                open = false;
                                setTimeout(() => {
                                    window.location.href = '{{ route('lupon-summon.download', $luponCase->id) }}?summoned_date=' + summoned_date + '&date_issued=' + date_issued;
                                }, 200);
                            ">
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Summon Date & Time</label>
                                    <input type="datetime-local" x-model="summoned_date" required
                                        class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-3 py-2 rounded-lg focus:ring-2 focus:ring-indigo-500">
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Date Issued</label>
                                    <input type="date" x-model="date_issued" required
                                        class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white px-3 py-2 rounded-lg focus:ring-2 focus:ring-indigo-500">
                                </div>
                                <div class="flex justify-end gap-2">
                                    <button type="button" @click="open = false"
                                        class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-400 dark:hover:bg-gray-500">Cancel</button>
                                    <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg">Generate PDF</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @if($luponSummonTrackings && $luponSummonTrackings->isNotEmpty())
                <div class="space-y-4">
                    @foreach($luponSummonTrackings as $summonTracking)
                        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5 border border-gray-200 dark:border-gray-700">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Date and Time</p>
                                    <p class="text-base text-gray-900 dark:text-gray-100">
                                        {{ \Carbon\Carbon::parse($summonTracking->date_time)->format('M j, Y g:i A') }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Received By</p>
                                    <p class="text-base text-gray-900 dark:text-gray-100">{{ $summonTracking->received_by ?? 'Not specified' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Served By</p>
                                    <p class="text-base text-gray-900 dark:text-gray-100">{{ $summonTracking->served_by ?? 'Not specified' }}</p>
                                </div>
                                <div class="md:col-span-2">
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Remarks</p>
                                    <p class="text-base text-gray-900 dark:text-gray-100">{{ $summonTracking->remarks ?? 'No remarks' }}</p>
                                </div>
                            </div>
                            <div class="flex gap-2 pt-4 border-t border-gray-200 dark:border-gray-700">
                                <x-secondary-button
                                    wire:click.stop="$dispatch('openModal', { component: 'modals.luponSummonTracking-modal', arguments: { luponSummonTracking: {{ $summonTracking->id }} }})"
                                    class="text-sm">
                                    Edit
                                </x-secondary-button>
                                <x-danger-button
                                    x-data
                                    @click.stop="if (confirm('Are you sure you want to delete this?')) { $wire.call('deleteSummon', {{ $summonTracking->id }}) }"
                                    class="text-sm">
                                    Delete
                                </x-danger-button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 text-gray-500 dark:text-gray-400">
                    <p>No summon records found.</p>
                </div>
            @endif
        </div>

        <!-- Hearing Tab -->
        <div x-show="openTab === 3" x-transition class="space-y-6">
            @if($luponHearingTrackings && $luponHearingTrackings->isNotEmpty())
                <div class="space-y-4">
                    @foreach($luponHearingTrackings as $hearingTracking)
                        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5 border border-gray-200 dark:border-gray-700">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Date and Time</p>
                                    <p class="text-base text-gray-900 dark:text-gray-100">
                                        {{ \Carbon\Carbon::parse($hearingTracking->date_time)->format('M j, Y g:i A') }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Type</p>
                                    <p class="text-base text-gray-900 dark:text-gray-100">{{ ucfirst($hearingTracking->type ?? 'Not specified') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Secretary</p>
                                    <p class="text-base text-gray-900 dark:text-gray-100">{{ $hearingTracking->secretary ?? 'Not specified' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Presider</p>
                                    <p class="text-base text-gray-900 dark:text-gray-100">{{ $hearingTracking->presider ?? 'Not specified' }}</p>
                                </div>
                                <div class="md:col-span-2">
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Remarks</p>
                                    <p class="text-base text-gray-900 dark:text-gray-100">{{ $hearingTracking->remarks ?? 'No remarks' }}</p>
                                </div>
                            </div>

                            @if($hearingTracking->assets->isNotEmpty())
                                <div class="mb-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Images</p>
                                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2">
                                        @foreach($hearingTracking->assets as $attachment)
                                            <a href="{{ asset('storage/' . $attachment->path) }}" target="_blank"
                                                class="block rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700 hover:border-indigo-500 dark:hover:border-indigo-400 transition-colors">
                                                <img src="{{ asset('storage/' . $attachment->path) }}" alt="Hearing image"
                                                    class="w-full h-24 object-cover">
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="flex gap-2 pt-4 border-t border-gray-200 dark:border-gray-700">
                                <x-secondary-button
                                    wire:click.stop="$dispatch('openModal', { component: 'modals.luponHearingTracking-modal', arguments: { luponHearingTracking: {{ $hearingTracking->id }} }})"
                                    class="text-sm">
                                    Edit
                                </x-secondary-button>
                                <x-danger-button
                                    x-data
                                    @click.stop="if (confirm('Are you sure you want to delete this?')) { $wire.call('deleteHearing', {{ $hearingTracking->id }}) }"
                                    class="text-sm">
                                    Delete
                                </x-danger-button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 text-gray-500 dark:text-gray-400">
                    <p>No hearing records found.</p>
                </div>
            @endif
        </div>
    </div>
</div>
