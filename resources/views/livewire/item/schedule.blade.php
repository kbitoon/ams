<div class="p-6">
    <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.itemSchedule-modal' })" class="mb-4">
        New Item Schedule
    </x-primary-button>

    <div class="overflow-x-auto">
        <table class="min-w-full border divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Start</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">End</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Item</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Quantity</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Status</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50"></th>
                </tr>
            </thead>

        @forelse($itemSchedules as $itemSchedule)
            <tr>
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    {{ $itemSchedule->formatted_start }}
                </td>
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    {{ $itemSchedule->formatted_end }}
                </td>
            
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    {{ $itemSchedule->item->name }}
                </td>

                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    {{ $itemSchedule->quantity }}
                </td>

                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    {{ $itemSchedule->status }}
                </td>

                
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    <x-secondary-button wire:click="$dispatch('openModal', { component: 'modals.show.item-schedule-modal', arguments: { itemSchedule: {{ $itemSchedule }} }})">
                        View
                    </x-secondary-button>
                    <x-secondary-button wire:click="$dispatch('openModal', { component: 'modals.item-schedule-modal', arguments: { itemSchedule: {{ $itemSchedule }} }})">
                        Edit
                    </x-secondary-button>
                @if($itemSchedule->status === '')
                    <x-secondary-button wire:click="updateStatus({{ $itemSchedule->id }}, 'Ongoing')">
                        Ongoing
                    </x-secondary-button>
                @elseif($itemSchedule->status === 'Ongoing')
                    <x-secondary-button wire:click="updateStatus({{ $itemSchedule->id }}, 'Done')">
                        Done
                    </x-secondary-button>
                @endif
                </td>
                
            </tr>
        @empty
            <tr>
                <td colspan="3" class="px-6 py-4 text-sm leading-5 text-gray-900">
                    No schedule available.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div class="mt-5">
        {{-- Pagination links --}}
        {{ $itemSchedules->links() }}
    </div>
</div>

