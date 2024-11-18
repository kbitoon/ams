<div class="min-w-full align-middle p-6 relative">
    <!-- Close button -->
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    <div class="pt-3 sm:pt-5">
        <h2 class="text-xl font-semibold text-black dark:text-white">{{ $activity->title }}
        </h2>
        <table class="mt-4 text-sm text-gray-800 dark:text-gray-300">
            <tbody>
                <tr>
                    <td class="py-2"><span class="font-semibold">Start:</span></td>
                    <td class="py-2">{{ \Carbon\Carbon::parse($activity->start)->format('F j, Y g:i A') }}</td>
                </tr>
                <tr>
                    <td class="py-2"><span class="font-semibold">End:</span></td>
                    <td class="py-2">{{ \Carbon\Carbon::parse($activity->start)->format('F j, Y g:i A') }}</td>
                </tr>
                <tr>
                    <td class="py-2"><span class="font-semibold">Description:</span></td>
                    <td class="py-2">{!! $activity->description ? $activity->description : "No description added." !!}</td>
                </tr>
                <tr>
                    <td class="py-2"><span class="font-semibold">Location:</span></td>
                    <td class="py-2">{!! $activity->location ? $activity->location: "No location added." !!} </td>
                </tr>
            </tbody>
        </table>

    </div>
</div>
