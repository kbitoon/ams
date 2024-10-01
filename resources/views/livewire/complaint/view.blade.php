<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    <div class="pt-3 sm:pt-5">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{!! $complaint->title !!}</h3>
        <div class="mt-4 text-sm/relaxed text-gray-800 dark:text-gray-300 space-y-2">
            <p><span class="font-semibold">{!! $complaint->name !!} | {!! $complaint->contact_number !!}</span><br>{{ $complaint->created_at->format('Y-m-d') }}</p>
            <p>{!! $complaint->content !!}</p>
            @if ($complaint->status === 'done')
                <p><span class="font-semibold">Approved By: </span> {!! $complaint->user->name !!}</p>
            @endif
        </div>
        
        <div class="mt-4">
            <h3 class="font-bold">Comments</h3>
            <div class="mb-4">
                @foreach($complaint->comments as $comment)
                    <div class="border-b py-2">
                        <strong>{{ $comment->user->name }}:</strong>
                        <p>{{ $comment->comment }}</p>
                        <p class="text-gray-500 text-sm">{{ $comment->created_at->format('Y-m-d') }}</p> <!-- Added created_at -->
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
