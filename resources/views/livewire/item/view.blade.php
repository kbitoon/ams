<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
<button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    <div class="pt-3 sm:pt-5">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{!! $item->name !!}</h3>
        
        <div class="mt-4 text-sm/relaxed text-gray-800 dark:text-gray-300 space-y-2">
            <p><span class="font-semibold">Quantity Left: </span> {!! $item->QuantityLeft !!}</p>
            <p><span class="font-semibold">Description: </span> {!! $item->description !!}</p>
            <p><span class="font-semibold">Acquisition Cost: </span> {!! $item->AcquisitionCost !!}</p>
        </div>
    </div>
</div>