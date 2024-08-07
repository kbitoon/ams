<div class="p-6">
    <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.item-modal' })" class="mb-4">
        New Item
    </x-primary-button>

    <div class="overflow-x-auto">
        <table class="min-w-full border divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Name</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Total Quantity</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50 md:table-cell">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Quantity Left</span>
                    </th>
                   
                    <th class="px-6 py-3 bg-gray-50"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($items as $item)
                    <tr>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            {{ $item->name }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            {{ $item->TotalQuantity }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 md:table-cell">
                            {{ $item->QuantityLeft }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            @hasanyrole('superadmin|administrator')
                                <x-secondary-button wire:click="$dispatch('openModal', { component: 'modals.item-modal', arguments: { item: {{ $item->id }} }})">
                                    Edit
                                </x-secondary-button>
                            @endhasanyrole
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-sm leading-5 text-gray-900">
                            No upcoming vehicle schedules.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-5">
        {{-- Pagination links --}}
        {{ $items->links() }}
    </div>
</div>
