<div>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 overflow-hidden overflow-x-auto bg-white border-b border-gray-200">
                    <div class="min-w-full align-middle">
                        <table class="min-w-full border divide-y divide-gray-200">
                            <!-- Table Header -->
                            <thead>
                            <tr>
                                <th class="px-6 py-3 text-left bg-gray-50">
                                    <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Name</span>
                                </th>
                                <th class="px-6 py-3 text-left bg-gray-50">
                                    <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Amount</span>
                                </th>
                                <th class="px-6 py-3 text-left bg-gray-50"></th>
                            </tr>
                            </thead>
                            <!-- Table Body -->
                            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                            <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.clearance-type-modal' })" class="mb-4">
                                New Clearance Type
                            </x-primary-button>
                            @forelse($clearanceTypes as $clearanceType)
                                <tr>
                                    <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                                        {{ $clearanceType->name }}
                                    </td>
                                    <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                                        {{ $clearanceType->amount }}
                                    </td>
                                    <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                                        <x-secondary-button wire:click="$dispatch('openModal', { component: 'modals.clearance-type-modal', arguments: { clearanceType: {{ $clearanceType }} }})">
                                            Edit
                                        </x-secondary-button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-4 text-sm leading-5 text-gray-900">
                                        No clearance type available.
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
