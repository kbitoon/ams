<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
    <div class="pt-3 sm:pt-5">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{!! $complaint->title!!}</h3>
        <div class="mt-4 text-sm/relaxed text-gray-800 dark:text-gray-300 space-y-2">
        <p><span class="font-semibold">{!! $complaint->name!!} | {!! $complaint->contact_number!!} </span></p>
            <p>{!! $complaint->content!!}</p>
            <p>{{ $complaint->created_at->format('Y-m-d') }}</p>
            @if ($complaint->status === 'done')
            <p><span class="font-semibold">Approved By: </span> {!! $complaint->user->name !!}</p>
            @endif
        </div>
    </div>
</div>