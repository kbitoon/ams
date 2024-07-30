<div class="min-w-full align-middle">
    <table class="min-w-full border divide-y divide-gray-200">
        <!-- Table Header -->
        <thead>
        <tr>
            <th class="px-6 py-3 text-left bg-gray-50">
                <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Name</span>
            </th>
            <th class="px-6 py-3 text-left bg-gray-50">
                <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Description</span>
            </th>
            <th class="px-6 py-3 text-left bg-gray-50">
            <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Status</span>
            </th>
            <th class="px-6 py-3 text-left bg-gray-50"></th>
        </tr>
        </thead>
        <!-- Table Body -->
        <tbody class="bg-white divide-y divide-gray-200 divide-solid">
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.vehicle-modal' })" class="mb-4">
            New Vehicle
        </x-primary-button>
        @forelse($vehicles as $vehicle)
            <tr>
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    {{ $vehicle->name }}
                </td>
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    {{ $vehicle->description }}
                </td>
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                {{ $vehicle->status }}
                </td>
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                        @hasanyrole('superadmin|administrator')
                            <x-secondary-button wire:click="$dispatch('openModal', { component: 'modals.vehicle-modal', arguments: { vehicle: {{ $vehicle }} }})">
                                EDIT
                            </x-secondary-button>
                        @endhasanyrole
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="px-6 py-4 text-sm leading-5 text-gray-900">
                    No vehicle available.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div class="mt-5">
        {{-- Pagination links --}}
        {{ $vehicles->links() }}
    </div>
</div>

