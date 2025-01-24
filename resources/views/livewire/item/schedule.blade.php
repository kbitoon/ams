<div class="p-6">

    <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-3">
            <!-- Date Filter -->
            <div>
                <label for="dateFilter" class="block text-sm font-medium text-gray-700">Filter by Date</label>
                <input type="date" id="dateFilter" wire:model.defer="tempDateFilter" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <!-- Item Filter -->
            <div>
                <label for="itemFilter" class="block text-sm font-medium text-gray-700">Filter by Item</label>
                <select id="itemFilter" wire:model.defer="tempItemFilter" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">All Items</option>
                    @foreach($items as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Status Filter -->
            <div>
                <label for="statusFilter" class="block text-sm font-medium text-gray-700">Filter by Status</label>
                <select id="statusFilter" wire:model.defer="tempStatusFilter" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">All Statuses</option>
                    <option value="Ongoing">Ongoing</option>
                    <option value="Done">Done</option>
                </select>
            </div>
        </div>
    <div class="mb-4 flex justify-center md:justify-end space-x-2">
        <x-primary-button wire:click="applyFilters">
            Apply Filters
        </x-primary-button>
    </div>
    <div class="mb-4 flex justify-center md:justify-start space-x-2">
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.itemSchedule-modal' })">
                    New Item Schedule
        </x-primary-button>
    </div>
    <div class="overflow-x-auto mt-5">
        <table class="min-w-full border divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Start</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Item</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">End</span>
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
             <tr class="hover:bg-gray-100 cursor-pointer"
                 wire:click="$dispatch('openModal', { component: 'modals.show.itemSchedule-modal', arguments: { itemSchedule: {{ $itemSchedule }} }})">
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    {{ $itemSchedule->formatted_start }}
                </td>
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    {{ $itemSchedule->item->name }}
                </td>
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    {{ $itemSchedule->formatted_end }}
                </td>

                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    {{ $itemSchedule->quantity }}
                </td>

                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    {{ $itemSchedule->status }}
                </td>

                
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    <div class="flex items-center space-x-2"> 
                        <x-secondary-button wire:click.stop="$dispatch('openModal', { component: 'modals.item-schedule-modal', arguments: { itemSchedule: {{ $itemSchedule }} }})">
                        <i class="fas fa-pencil-alt"></i>
                        </x-secondary-button>
                    @if($itemSchedule->status === 'Pending')
                        <x-secondary-button wire:click.stop="updateStatus({{ $itemSchedule->id }}, 'Ongoing')">
                        <i class="fas fa-hourglass-half mr-1"></i>
                        </x-secondary-button>
                    @elseif($itemSchedule->status === 'Ongoing')
                        <x-secondary-button wire:click.stop="updateStatus({{ $itemSchedule->id }}, 'Done')">
                        <i class="fas fa-check mr-1"></i>
                        </x-secondary-button>
                    @endif
                    </div>
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

