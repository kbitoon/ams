<div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-h-[90vh] overflow-y-auto">
    <!-- Sticky Header -->
    <div class="sticky top-0 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-4 sm:px-6 py-4 flex items-start justify-between z-10">
        <div class="flex-1 pr-4">
            <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-gray-100 leading-tight">
                {{ $complaint->title }}
            </h2>
            <div class="mt-2 flex flex-wrap items-center gap-2">
                @if($complaint->category)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                        {{ $complaint->category->name }}
                    </span>
                @endif
                @if($complaint->is_pinned)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                        Pinned
                    </span>
                @endif
                @if($complaint->status === 'Pending')
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                        Pending
                    </span>
                @else
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                        Done
                    </span>
                @endif
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
        <!-- Metadata Section -->
        <div class="flex flex-col sm:flex-row sm:items-center gap-3 text-sm text-gray-600 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700 pb-4">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                </svg>
                <span>{{ $complaint->created_at->format('F d, Y') }}</span>
            </div>
            @if($complaint->user)
                <span class="hidden sm:inline text-gray-300 dark:text-gray-600">•</span>
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    <span>Posted by {{ $complaint->user->name }}</span>
                </div>
            @endif
        </div>

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
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Name</p>
                    <p class="text-base text-gray-900 dark:text-gray-100">{{ $complaint->name }}</p>
                </div>
                @if($complaint->contact_number)
                <div>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Contact Number</p>
                    <p class="text-base text-gray-900 dark:text-gray-100">{{ $complaint->contact_number }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Content Section -->
        <div class="prose prose-sm sm:prose-base max-w-none dark:prose-invert">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3">Complaint Details</h3>
            <div class="text-gray-900 dark:text-gray-100 leading-relaxed">
                {!! $complaint->content !!}
            </div>
        </div>

        <!-- Attachments Section -->
        @if($complaint->assets && $complaint->assets->isNotEmpty())
        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13" />
                </svg>
                Attachments
            </h3>
            <div class="space-y-2">
                @foreach($complaint->assets as $attachment)
                    <a href="{{ asset('storage/' . $attachment->path) }}" target="_blank"
                        class="flex items-center gap-3 p-3 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-red-300 dark:hover:border-red-600 transition-all group">
                        <div class="flex-shrink-0 p-2 bg-gray-100 dark:bg-gray-700 rounded-lg group-hover:bg-red-100 dark:group-hover:bg-red-900/20 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-400 group-hover:text-red-600 dark:group-hover:text-red-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                        </div>
                        <span class="text-sm text-gray-900 dark:text-gray-100 group-hover:text-red-600 dark:group-hover:text-red-400 flex-1 truncate font-medium">
                            {{ basename($attachment->path) }}
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-gray-400 group-hover:text-red-600 dark:group-hover:text-red-400 flex-shrink-0">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                        </svg>
                    </a>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Approval Information -->
        @if($complaint->status === 'Done' && $complaint->approvedBy)
        <div class="bg-green-50 dark:bg-green-900/20 rounded-lg p-4 sm:p-5 border border-green-200 dark:border-green-800">
            <div class="flex items-center gap-3">
                <div class="flex-shrink-0 p-2 bg-green-100 dark:bg-green-900/30 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-green-600 dark:text-green-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-green-800 dark:text-green-200">Approved By</p>
                    <p class="text-base font-semibold text-green-900 dark:text-green-100">{{ $complaint->approvedBy->name }}</p>
                </div>
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
                @if($complaint->comments && $complaint->comments->count() > 0)
                    <span class="ml-2 px-2 py-0.5 text-xs font-medium bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full">
                        {{ $complaint->comments->count() }}
                    </span>
                @endif
            </h3>
            
            @if($complaint->comments && $complaint->comments->isNotEmpty())
            <div class="space-y-4 mt-4">
                @foreach($complaint->comments as $comment)
                    <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-200 dark:border-gray-700">
                        <div class="flex items-start justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <div class="flex-shrink-0 p-1.5 bg-red-100 dark:bg-red-900/20 rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-red-600 dark:text-red-400">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $comment->user->name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $comment->created_at->format('F j, Y g:i A') }}</p>
                                </div>
                            </div>
                        </div>
                        <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed mt-2">{{ $comment->comment }}</p>
                    </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-8">
                <p class="text-gray-500 dark:text-gray-400">No comments yet.</p>
            </div>
            @endif

            @if(auth()->user() && auth()->user()->hasAnyRole(['superadmin', 'administrator']))
            <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                <form action="{{ route('comments.store', $complaint->id) }}" method="POST" class="space-y-3">
                    @csrf
                    <div>
                        <label for="comment" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Add a comment
                        </label>
                        <textarea 
                            name="comment" 
                            id="comment"
                            rows="3"
                            placeholder="Write your comment here..."
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white resize-y"
                            required
                        ></textarea>
                    </div>
                    <x-primary-button type="submit" class="bg-red-600 hover:bg-red-700 focus:ring-red-500">
                        Submit Comment
                    </x-primary-button>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>
