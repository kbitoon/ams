<div class="container mx-auto p-4">

    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $complaint->title }}</h3>
        <div class="mt-4 text-sm/relaxed text-gray-800 dark:text-gray-300 space-y-2">
            <p><span class="font-semibold">{{ $complaint->name }} | {{ $complaint->contact_number }}</span><br>
            <span class ="block text-gray-500 dark:text-gray-400" style="font-size: 0.65rem;">
                {{ $complaint->created_at->format('F j, Y') }}
            </span></p>
            <p>{{ $complaint->content }}</p>
            @if ($complaint->status === 'Done')
                <p><span class="font-semibold">Approved By: </span> {{ $complaint->user->name }}</p>
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

        <div class="mt-4 text-sm/relaxed text-gray-800 dark:text-gray-300 space-y-2">
            <h3 class="font-bold">Comments</h3>
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
    </div>
</div>
