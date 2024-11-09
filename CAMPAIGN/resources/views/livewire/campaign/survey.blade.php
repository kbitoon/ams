<div class="min-w-full align-middle">
    
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
        <!-- Left side with buttons -->
        <div class="flex items-center gap-4">
            <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.survey-modal' })">
                New Survey
            </x-primary-button>
            <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.candidate-modal' })">
                New Candidate
            </x-primary-button>
        </div>

        <!-- Right side with date filter -->
        <div class="flex flex-col items-start gap-2 md:items-end">
            <div class="flex flex-col sm:flex-row items-start gap-4">
                <div class="flex flex-col">
                    <label for="start_date" class="text-sm font-medium text-gray-700">Start Date</label>
                    <input type="date" id="start_date" wire:model="startDate" class="border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="flex flex-col">
                    <label for="end_date" class="text-sm font-medium text-gray-700">End Date</label>
                    <input type="date" id="end_date" wire:model="endDate" class="border-gray-300 rounded-md shadow-sm">
                </div>
            </div>
            <!-- Filter button below the date fields -->
            <x-primary-button wire:click="filterByDate" class="mt-2 sm:mt-0">
                Filter
            </x-primary-button>
        </div>
    </div>

    <!-- Mayor Table -->
    <h2 class="text-lg font-semibold mt-6">Mayor Survey Result</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full border divide-y divide-gray-200">
            <!-- Table Header -->
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Candidate</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Votes</span>
                    </th>
                </tr>
            </thead>
            <!-- Table Body -->
            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                @forelse($surveys->where('candidate.position', 'Mayor') as $survey)
                    <tr>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            {{ $survey->candidate->name }} <!-- Candidate Name -->
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            {{ $survey->votes }} <!-- Displays vote count -->
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-6 py-4 text-sm leading-5 text-gray-900">
                            No mayor survey result available.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Vice Mayor Table -->
    <h2 class="text-lg font-semibold mt-6">Vice Mayor Survey Result</h2>
    <div class="overflow-x-auto mt-4">
        <table class="min-w-full border divide-y divide-gray-200">
            <!-- Table Header -->
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Candidate</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Votes</span>
                    </th>
                </tr>
            </thead>
            <!-- Table Body -->
            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                @forelse($surveys->where('candidate.position', 'Vice Mayor') as $survey)
                    <tr>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            {{ $survey->candidate->name }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            {{ $survey->votes }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-6 py-4 text-sm leading-5 text-gray-900">
                            No vice mayor survey result available.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Congress Table -->
    <h2 class="text-lg font-semibold mt-6">Congress Survey Result</h2>
    <div class="overflow-x-auto mt-4">
        <table class="min-w-full border divide-y divide-gray-200">
            <!-- Table Header -->
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Candidate</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Votes</span>
                    </th>
                </tr>
            </thead>
            <!-- Table Body -->
            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                @forelse($surveys->where('candidate.position', 'Congress') as $survey)
                    <tr>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            {{ $survey->candidate->name }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            {{ $survey->votes }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-6 py-4 text-sm leading-5 text-gray-900">
                            No congress survey result available.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    <!-- Councilor Table -->
    <h2 class="text-lg font-semibold mt-6">Councilor Survey Result</h2>
    <div class="overflow-x-auto mt-4">
        <table class="min-w-full border divide-y divide-gray-200">
            <!-- Table Header -->
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Candidate</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Votes</span>
                    </th>
                </tr>
            </thead>
            <!-- Table Body -->
            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                @forelse($surveys->where('candidate.position', 'Councilor') as $survey)
                    <tr>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            {{ $survey->candidate->name }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            {{ $survey->votes }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-6 py-4 text-sm leading-5 text-gray-900">
                            No councilor survey result available.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    
    </div>

    <div class="mt-5">
        {{-- Pagination links, if needed, can be added here --}}
        {{ $surveys->links() }}
    </div>
</div>
