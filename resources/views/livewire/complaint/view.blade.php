<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    <div class="pt-3 sm:pt-5">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{!! $complaint->title !!}</h3>
        <div class="mt-4 text-sm/relaxed text-gray-800 dark:text-gray-300 space-y-2">
        <p>
            <span class="font-semibold">
                {!! $complaint->name !!}
                @if ($complaint->contact_number)
                | {!! $complaint->contact_number !!}
                @endif
                </span>
            <p>{!! $complaint->content !!}</p>
            @if ($complaint->status === 'Done')
                <p><span class="font-semibold">Approved By: </span> {!! $complaint->user->name !!}</p>
            @endif
        </div>
        <!-- Attachments Section -->
        <div class="mt-4 text-sm/relaxed text-gray-800 dark:text-gray-300 space-y-2">
            <h3 class="font-semibold">Attachments</h3>
            <ul class="list-disc list-inside space-y-2">
                @foreach($complaint->assets as $attachment)
                    <li>
                        <a href="{{ Storage::url($attachment->path) }}" target="_blank" class="text-blue-500 hover:underline">
                            {{ basename($attachment->path) }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        
        <div class="mt-4 text-sm/relaxed text-gray-800 dark:text-gray-300 space-y-2">
            <h3 class="font-bold">Comments</h3>
            <div class="text-sm/relaxed text-gray-800 dark:text-gray-300 space-y-2">
                @foreach($complaint->comments as $comment)
                    <div class="border-b py-2">
                        <span class='font-semibold'>{{ $comment->user->name }}:</span>
                        <p class="block text-gray-500 dark:text-gray-400" style="font-size: 0.65rem;">{{ $comment->created_at->format('F j, Y') }}</p>
                        <p>{{ $comment->comment }}</p>
                    </div>
                @endforeach
            </div>

            @if(auth()->user()->hasRole('superadmin|administrator'))
                <form action="{{ route('comments.store', $complaint->id) }}" method="POST">
                    @csrf
                    <textarea name="comment" placeholder="Add a comment..." class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                    <x-primary-button type="submit">Submit Comment</x-primary-button>
                </form>
            @endif
        </div>
    </div>
</div>
