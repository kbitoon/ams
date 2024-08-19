<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
    <div class="pt-3 sm:pt-5">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">More Information</h3>
        
        <div class="mt-4 text-sm/relaxed text-gray-800 dark:text-gray-300 space-y-2">
            <p><span class="font-semibold">Date: </span> {!! $clearance->date !!}</p>
            <p><span class="font-semibold">Amount: </span> {!! $clearance->amount !!}</p>
            <p><span class="font-semibold">Notes: </span> {!! $clearance->notes !!}</p>
            <p><span class="font-semibold">Contact Number: </span> {!! $clearance->contact_number !!}</p>
            <p><span class="font-semibold">Status: </span> {!! $clearance->status !!}</p>

            @if ($clearance->status === 'done')
            <p><span class="font-semibold">Approved By: </span> {!! $clearance->user->name !!}</p>
            @endif
        </div>
    </div>
</div>