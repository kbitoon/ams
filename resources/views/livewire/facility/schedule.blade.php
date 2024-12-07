<div class="p-6">
    <!-- Table Section -->
    <div class="flex justify-between items-center mb-4 mr-2">
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.facilitySchedule-modal' })" class="h-8 mr-2">
            <span class="hidden sm:inline">New Facility Schedule</span>
            <span class="inline sm:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </span>
        </x-primary-button>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full border divide-y divide-gray-200">
            <thead>
                <tr>
                <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Facility</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Start</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">End</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Name</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Purpose</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Status</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($facilitySchedules as $facilitySchedule)
                <tr class="hover:bg-gray-100 cursor-pointer">
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                        {{ $facilitySchedule->facility->name }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                        {{ $facilitySchedule->start }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                        {{ $facilitySchedule->end }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                        {{ $facilitySchedule->name }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                        {{ $facilitySchedule->purpose }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                        {{ $facilitySchedule->status }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                        @hasanyrole('superadmin|administrator')
                            <x-secondary-button 
                                wire:click.stop="$dispatch('openModal', { component: 'modals.facilitySchedule-modal', arguments: { facilitySchedule: {{ $facilitySchedule->id }} }})">
                                <i class="fas fa-pencil-alt"></i>
                            </x-secondary-button>
                            <x-danger-button wire:click.stop="delete({{ $facilitySchedule->id }})" onclick="return confirm('Are you sure you want to delete this?')">
                                <i class="fas fa-trash-alt"></i>
                            </x-danger-button>
                        @endhasanyrole
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-sm leading-5 text-gray-900">
                        No facility schedule found.
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    <div class="mt-5">
        {{-- Pagination links --}}
        {{ $facilitySchedules->links() }}
    </div>

    
