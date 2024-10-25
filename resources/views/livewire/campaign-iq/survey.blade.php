<div class="min-w-full align-middle">
    <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.survey-modal' })" class="mb-4">
        New Survey
    </x-primary-button>
    <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.candidate-modal' })" class="mb-4">
        New Candidate
    </x-primary-button>

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
