<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 h-auto">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    <div class="pt-3 sm:pt-5">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">More Information</h3>
        
        <table class="mt-4 text-sm text-gray-800 dark:text-gray-300">
            <tbody>
                <tr>
                    <td class="py-2"><span class="font-semibold">Location:</span></td>
                    <td class="py-2">{!! $itemSchedule->location !!}</td>
                </tr>
                <tr>
                    <td class="py-2"><span class="font-semibold">Purpose:</span></td>
                    <td class="py-2">{!! $itemSchedule->purpose !!}</td>
                </tr>
                <tr>
                    <td class="py-2"><span class="font-semibold">Assigned To:</span></td>
                    <td class="py-2">{!! $itemSchedule->assigned !!}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
