<div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-h-[90vh] overflow-y-auto">
    <!-- Sticky Header -->
    <div class="sticky top-0 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-4 sm:px-6 py-4 flex items-start justify-between z-10">
        <div class="flex-1 pr-4">
            <div class="flex items-center gap-4">
                @if($user->photo)
                    <div class="flex-shrink-0">
                        <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}" class="w-16 h-16 rounded-full object-cover border-2 border-gray-200 dark:border-gray-700">
                    </div>
                @else
                    <div class="flex-shrink-0 w-16 h-16 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white text-2xl font-bold">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif
                <div class="flex-1 min-w-0">
                    <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-gray-100 leading-tight">
                        {{ $user->name }}
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $user->email }}</p>
                    <div class="mt-2 flex flex-wrap items-center gap-2">
                        @if($user->roles->isNotEmpty())
                            @foreach($user->roles as $role)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                      style="background-color: {{ $role->color ?? '#e2e8f0' }}; color: {{ $role->color && !str_starts_with($role->color, '#') ? 'black' : 'white' }};">
                                    {{ ucfirst($role->name) }}
                                </span>
                            @endforeach
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                No role assigned
                            </span>
                        @endif
                    </div>
                </div>
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
        @php
            $personalInfo = $user->personalInformation;
        @endphp

        <!-- Account Information Section -->
        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
                Account Information
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</p>
                    <p class="text-base text-gray-900 dark:text-gray-100 mt-1">{{ $user->email }}</p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Email Verified</p>
                    <p class="text-base text-gray-900 dark:text-gray-100 mt-1">
                        @if($user->email_verified_at)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                Verified
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                Not Verified
                            </span>
                        @endif
                    </p>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Account Created</p>
                    <p class="text-base text-gray-900 dark:text-gray-100 mt-1">{{ $user->created_at->format('F d, Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Personal Information Section -->
        @if($personalInfo)
        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0z" />
                </svg>
                Personal Information
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @if($personalInfo->contact_number)
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Contact Number</p>
                    <p class="text-base text-gray-900 dark:text-gray-100 mt-1">{{ $personalInfo->contact_number }}</p>
                </div>
                @endif
                @if($personalInfo->birthdate)
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Birthdate</p>
                    <p class="text-base text-gray-900 dark:text-gray-100 mt-1">{{ $personalInfo->birthdate }}</p>
                </div>
                @endif
                @if($personalInfo->address)
                <div class="md:col-span-2">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Address</p>
                    <p class="text-base text-gray-900 dark:text-gray-100 mt-1">{{ $personalInfo->address }}</p>
                </div>
                @endif
                @if($personalInfo->sitio)
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Sitio</p>
                    <p class="text-base text-gray-900 dark:text-gray-100 mt-1">{{ $personalInfo->sitio }}</p>
                </div>
                @endif
                @if($personalInfo->blood_type)
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Blood Type</p>
                    <p class="text-base text-gray-900 dark:text-gray-100 mt-1">{{ $personalInfo->blood_type }}</p>
                </div>
                @endif
                @if($personalInfo->willing_blood_donor)
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Willing Blood Donor</p>
                    <p class="text-base text-gray-900 dark:text-gray-100 mt-1">{{ $personalInfo->willing_blood_donor }}</p>
                </div>
                @endif
                @if($personalInfo->occupation)
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Occupation</p>
                    <p class="text-base text-gray-900 dark:text-gray-100 mt-1">{{ $personalInfo->occupation }}</p>
                </div>
                @endif
                @if($personalInfo->income)
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Income</p>
                    <p class="text-base text-gray-900 dark:text-gray-100 mt-1">₱{{ number_format($personalInfo->income, 2) }}</p>
                </div>
                @endif
                @if($personalInfo->civil_status)
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Civil Status</p>
                    <p class="text-base text-gray-900 dark:text-gray-100 mt-1">{{ $personalInfo->civil_status }}</p>
                </div>
                @endif
                @if($personalInfo->education)
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Education</p>
                    <p class="text-base text-gray-900 dark:text-gray-100 mt-1">{{ $personalInfo->education }}</p>
                </div>
                @endif
                @if($personalInfo->financial_assistance)
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Financial Assistance</p>
                    <p class="text-base text-gray-900 dark:text-gray-100 mt-1">{{ $personalInfo->financial_assistance }}</p>
                </div>
                @endif
                @if($personalInfo->living_in_danger_zone)
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Living in Danger Zone</p>
                    <p class="text-base text-gray-900 dark:text-gray-100 mt-1">{{ $personalInfo->living_in_danger_zone }}</p>
                </div>
                @endif
                @if($personalInfo->registered_voter)
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Registered Voter</p>
                    <p class="text-base text-gray-900 dark:text-gray-100 mt-1">{{ $personalInfo->registered_voter }}</p>
                </div>
                @endif
                @if($personalInfo->weight)
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Weight</p>
                    <p class="text-base text-gray-900 dark:text-gray-100 mt-1">{{ $personalInfo->weight }} kg</p>
                </div>
                @endif
                @if($personalInfo->height)
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Height</p>
                    <p class="text-base text-gray-900 dark:text-gray-100 mt-1">{{ $personalInfo->height }} cm</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Family Information Section -->
        @if($personalInfo->father_firstname || $personalInfo->father_lastname || $personalInfo->mother_firstname || $personalInfo->mother_lastname)
        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.645-5.888-1.664a3.001 3.001 0 00-4.682 2.72 9.097 9.097 0 003.741.488m-11.5-3.68c.01.103.022.207.037.31.074.196.232.354.428.428a10.07 10.07 0 005.394 0c.196-.074.354-.232.428-.428a9.148 9.148 0 00.037-.31m-11.5-3.68a9.505 9.505 0 0111.5 0M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                </svg>
                Family Information
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @if($personalInfo->father_firstname || $personalInfo->father_lastname)
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Father's Name</p>
                    <p class="text-base text-gray-900 dark:text-gray-100 mt-1">
                        {{ trim(($personalInfo->father_firstname ?? '') . ' ' . ($personalInfo->father_lastname ?? '')) ?: 'N/A' }}
                    </p>
                </div>
                @endif
                @if($personalInfo->mother_firstname || $personalInfo->mother_lastname)
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Mother's Name</p>
                    <p class="text-base text-gray-900 dark:text-gray-100 mt-1">
                        {{ trim(($personalInfo->mother_firstname ?? '') . ' ' . ($personalInfo->mother_lastname ?? '')) ?: 'N/A' }}
                    </p>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Emergency Contact Section -->
        @if($personalInfo->emergency_contact_person || $personalInfo->emergency_contact_number)
        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.69a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                </svg>
                Emergency Contact
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @if($personalInfo->emergency_contact_person)
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Contact Person</p>
                    <p class="text-base text-gray-900 dark:text-gray-100 mt-1">{{ $personalInfo->emergency_contact_person }}</p>
                </div>
                @endif
                @if($personalInfo->emergency_contact_number)
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Contact Number</p>
                    <p class="text-base text-gray-900 dark:text-gray-100 mt-1">{{ $personalInfo->emergency_contact_number }}</p>
                </div>
                @endif
            </div>
        </div>
        @endif
        @else
        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
            <p class="text-gray-500 dark:text-gray-400 text-center py-4">No personal information available</p>
        </div>
        @endif
    </div>
</div>

