<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    <div class="pt-3 sm:pt-5">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{!! $item->name !!}</h3>
        
        <table width="100%">
            <tbody>
                <tr>
                    <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Quantity Left:</td>
                    <td class="py-2">{!! $item->QuantityLeft !!}</td>
                </tr>
                <tr style="background: #eeeeee">
                    <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Description:</td>
                    <td class="py-2">{!! $item->description !!}</td>
                </tr>
                <tr>
                    <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Acquisition Cost:</td>
                    <td class="py-2">{!! $item->AcquisitionCost !!}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
