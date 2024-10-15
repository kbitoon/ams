<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    <div class="pt-3 sm:pt-5">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{!! $item->name !!}</h3>
        
        <table class="mt-4 text-sm text-gray-800 dark:text-gray-300">
            <tbody>
                <tr>
                    <td class="py-2"><span class="font-semibold">Quantity Left:</span></td>
                    <td class="py-2">{!! $item->QuantityLeft !!}</td>
                </tr>
                <tr>
                    <td class="py-2"><span class="font-semibold">Description:</span></td>
                    <td class="py-2">{!! $item->description !!}</td>
                </tr>
                <tr>
                    <td class="py-2"><span class="font-semibold">Acquisition Cost:</span></td>
                    <td class="py-2">{!! $item->AcquisitionCost !!}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
