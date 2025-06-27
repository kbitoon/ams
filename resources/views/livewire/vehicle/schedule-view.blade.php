<div class="relative bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
    <button
        class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 dark:hover:text-gray-200 focus:outline-none text-2xl"
        wire:click="closeModal"
        aria-label="Close">
        &times;
    </button>

    <div class="pt-3 sm:pt-5">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">
            {{ $vehicleSchedule->destination }}
        </h3>

        <table class="text-sm text-left text-gray-800 dark:text-gray-300">
            <tbody>
                <tr>
                    <th class="py-1 pr-2 font-medium whitespace-nowrap">Name:</th>
                    <td class="py-1">testing</td>
                </tr>
                <tr>
                    <th class="py-1 pr-2 font-medium whitespace-nowrap">Vehicle:</th>
                    <td class="py-1">testing</td>
                </tr>
                <tr>
                    <th class="py-1 pr-2 font-medium whitespace-nowrap">Driver:</th>
                    <td class="py-1">testing</td>
                </tr>
                <tr>
                    <th class="py-1 pr-2 font-medium whitespace-nowrap">Start Date:</th>
                    <td class="py-1">Jun 20, 2025 11:01</td>
                </tr>
                <tr>
                    <th class="py-1 pr-2 font-medium whitespace-nowrap">End Date:</th>
                    <td class="py-1">Jun 21, 2025 11:01</td>
                </tr>
                <tr>
                    <th class="py-1 pr-2 font-medium align-top whitespace-nowrap">Details:</th>
                    <td class="py-1">asdsadasdasdsad</td>
                </tr>
            </tbody>
        </table>


    </div>
</div>