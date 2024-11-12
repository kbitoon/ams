<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Track Your Complaint') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Complaint Tracking Form --}}
                    <div class="container mx-auto p-4">
                        <div class="bg-white shadow-md rounded-md p-6">
                            @if (session('error'))
                                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-md">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form action="{{ route('track-complaint.submit') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label for="reference_id" class="block text-sm font-medium text-gray-700">
                                        {{ __('Reference ID') }}
                                    </label>
                                    <input type="text" id="reference_id" name="reference_id" required
                                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:outline-none"
                                        placeholder="{{ __('Enter your reference ID') }}">
                                </div>

                                <div>
                                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                        {{ __('Track') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Display Complaint Details if Found --}}
                    @if(isset($complaint))
                        <div class="container mx-auto p-4 mt-8">
                            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $complaint->title }}</h3>
                                <div class="mt-4 text-sm/relaxed text-gray-800 dark:text-gray-300 space-y-2">
                                    <p><span class="font-semibold">{{ $complaint->name }} ({{ $complaint->contact_number }}) </span><br>
                                    <span class ="block text-gray-500 dark:text-gray-400" style="font-size: 0.65rem;">
                                        {{ $complaint->created_at->format('F j, Y') }} | {{$complaint->status}}
                                    </span></p>
                                    <p>{{ strip_tags($complaint->content) }}</p>
                                    @if ($complaint->status === 'Done')
                                        <p><span class="font-semibold">Approved By: </span> {{ $complaint->approvedBy->name }}</p>
                                    @endif
                                </div>

                                <!-- Attachments Section -->
                                <div class="mt-4 text-sm/relaxed text-gray-800 dark:text-gray-300 space-y-2">
                                    <h3 class="font-semibold">Attachments</h3>
                                    <div class="space-y-2">
                                        @foreach($complaint->assets as $attachment)
                                            <div>
                                                <a href="{{ Storage::url($attachment->path) }}" target="_blank" class="text-blue-500 hover:underline">
                                                    {{ basename($attachment->path) }}
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                    <h2 class="font-bold">Updates</h2>

                                    @if ($complaint->comments->isEmpty())
                                    <p>No updates</p>
                                    @else
                                    <div class="text-sm/relaxed text-gray-800 dark:text-gray-300 space-y-2">
                                        @foreach($complaint->comments as $comment)
                                            <div class="border-b py-2">
                                                <span class='font-semibold'>{{ $comment->user->name }}:</span>
                                                <p class="block text-gray-500 dark:text-gray-400" style="font-size: 0.65rem;">
                                                    {{ $comment->created_at->format('F j, Y') }}
                                                </p>
                                                <p>{{ $comment->comment }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
