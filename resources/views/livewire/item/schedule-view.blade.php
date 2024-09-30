<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 h-auto">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none" wire:click="closeModal">
        &times;
    </button>
    <div class="pt-3 sm:pt-5">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">More Information</h3>
        
        <div class="mt-4 text-sm/relaxed text-gray-800 dark:text-gray-300 space-y-2">
            <p><span class="font-semibold">Location:</span> {!! $itemSchedule->location !!}</p>
            <p><span class="font-semibold">Purpose:</span> {!! $itemSchedule->purpose !!}</p>
            <p><span class="font-semibold">Assigned To:</span> {!! $itemSchedule->assigned !!}</p>
        </div>
    </div>
</div>