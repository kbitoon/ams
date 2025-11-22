<div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-h-[90vh] overflow-y-auto">
    @php
        $pdfRoutes = [
            'Certification' => 'certificate.download',
            'Open Bank Account' => 'certificate.download',
            'Postal ID' => 'certificate.download',
            'Police Clearance' => 'certificate.download',
            'Employment' => 'certificate.download',
            'NBI Clearance' => 'certificate.download',
            'PWD Membership' => 'certificate.download',
            'School Enrollment' => 'certificate.download',
            'SSS Requirement' => 'certificate.download',
            'Solo Parent Membership' => 'certificate.download',
            'Senior Citizen Membership' => 'certificate.download',
            'Certificate of Indigency' => 'indigency.download',
            'Electrical connection' => 'electrical.download',
        ];
        $typeName = optional($clearance->type)->name;
    @endphp

    <!-- Header -->
    <div class="sticky top-0 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-4 sm:px-6 py-4 flex items-center justify-between z-10">
        <div class="flex-1">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-gray-100">
                {{ $clearance->type->name }}
            </h2>
            <div class="mt-1 flex flex-wrap items-center gap-2">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $clearance->status === 'Done' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' }}">
                    {{ $clearance->status }}
                </span>
            </div>
        </div>
        <div class="flex items-center gap-2 ml-4">
            @if(isset($pdfRoutes[$typeName]))
                <a href="{{ route($pdfRoutes[$typeName], $clearance->id) }}" target="_blank"
                    class="p-2 text-red-600 hover:text-red-800 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-red-500"
                    title="Download PDF">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                </a>
            @endif
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

    <!-- Content -->
    <div class="p-4 sm:p-6 space-y-6">
        <!-- Personal Information Section -->
        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                Personal Information
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Full Name</div>
                    <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $clearance->name }}</div>
                </div>
                <div>
                    <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Contact Number</div>
                    <div class="text-sm text-gray-900 dark:text-gray-100">{{ $clearance->contact_number }}</div>
                </div>
                <div>
                    <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Date of Birth</div>
                    <div class="text-sm text-gray-900 dark:text-gray-100">
                        {{ $clearance->date_of_birth ? \Carbon\Carbon::parse($clearance->date_of_birth)->format('F j, Y') : 'N/A' }}
                    </div>
                </div>
                <div>
                    <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Age</div>
                    <div class="text-sm text-gray-900 dark:text-gray-100">{{ $clearance->age ?? 'N/A' }}</div>
                </div>
                <div>
                    <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Gender</div>
                    <div class="text-sm text-gray-900 dark:text-gray-100">{{ $clearance->sex ?? 'N/A' }}</div>
                </div>
                <div>
                    <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Civil Status</div>
                    <div class="text-sm text-gray-900 dark:text-gray-100">{{ $clearance->civil_status ?? 'N/A' }}</div>
                </div>
                @if($clearance->precinct_no)
                <div>
                    <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Precinct No.</div>
                    <div class="text-sm text-gray-900 dark:text-gray-100">{{ $clearance->precinct_no }}</div>
                </div>
                @endif
            </div>
        </div>

        <!-- Address Section -->
        @if($clearance->address)
        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                Address
            </h3>
            <div class="text-sm text-gray-900 dark:text-gray-100 uppercase font-medium">
                {{ $clearance->address }}
            </div>
        </div>
        @endif

        <!-- Clearance Details Section -->
        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                Clearance Details
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Date</div>
                    <div class="text-sm text-gray-900 dark:text-gray-100">
                        {{ $clearance->date ? \Carbon\Carbon::parse($clearance->date)->format('F j, Y') : 'N/A' }}
                    </div>
                </div>
                <div>
                    <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Amount</div>
                    <div class="text-sm text-gray-900 dark:text-gray-100">
                        ₱{{ number_format($clearance->amount, 2) }}
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Purpose</div>
                    <div class="text-sm text-gray-900 dark:text-gray-100">{{ $clearance->purpose ?? 'N/A' }}</div>
                </div>
                @if($clearance->notes)
                <div class="sm:col-span-2">
                    <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Notes</div>
                    <div class="text-sm text-gray-900 dark:text-gray-100 whitespace-pre-wrap">{{ $clearance->notes }}</div>
                </div>
                @endif
            </div>
        </div>

        <!-- Attachments Section -->
        @if(!$clearance->assets->isEmpty())
        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                Attachments
            </h3>
            <div class="space-y-2">
                @foreach($clearance->assets as $attachment)
                    <a href="{{ Storage::url($attachment->path) }}" target="_blank"
                        class="flex items-center gap-2 p-3 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400 group-hover:text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                        <span class="text-sm text-gray-900 dark:text-gray-100 group-hover:text-blue-600 dark:group-hover:text-blue-400 flex-1 truncate">
                            {{ basename($attachment->path) }}
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-400 group-hover:text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                        </svg>
                    </a>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Approval Information -->
        @if ($clearance->status === 'Done' && $clearance->approvedBy)
        <div class="bg-green-50 dark:bg-green-900/20 rounded-lg p-4 sm:p-5 border border-green-200 dark:border-green-800">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">
                Approval Information
            </h3>
            <div class="text-sm text-gray-700 dark:text-gray-300">
                <span class="font-medium">Approved by:</span>
                <span class="ml-2">{{ $clearance->approvedBy->name }}</span>
            </div>
        </div>
        @endif
    </div>
</div>