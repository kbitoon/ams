<div class="p-6">

    <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-3">
                <!-- Date Filter -->
                <div>
                    <label for="dateFilter" class="block text-sm font-medium text-gray-700">Filter by Date</label>
                    <input type="date" id="dateFilter" wire:model.defer="tempDateFilter" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- Facility Filter -->
                <div>
                    <label for="facilityFilter" class="block text-sm font-medium text-gray-700">Filter by Facility</label>
                    <select id="facilityFilter" wire:model.defer="tempFacilityFilter" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">All Facilities</option>
                        @foreach($facilities as $facility)
                            <option value="{{ $facility->id }}">{{ $facility->name }}</option>
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
                    {{ \Carbon\Carbon::parse($facility->start)->format('M j, Y g:i A') }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    {{ \Carbon\Carbon::parse($facility->end)->format('M j, Y g:i A') }}
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
                    </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            <div class="flex items-center space-x-2">
                                @hasanyrole('superadmin|administrator|support')
                                        <x-secondary-button wire:click="$dispatch('openModal', { component: 'modals.facilitySchedule-modal', arguments: { facilitySchedule: {{ $facilitySchedule }} }})">
                                            <i class="fas fa-pencil-alt"></i>
                                        </x-secondary-button>
                                        <x-danger-button wire:click.stop="delete({{ $facilitySchedule->id }})" onclick="return confirm('Are you sure you want to delete this?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </x-danger-button>
                                @endhasanyrole
                                @if(is_null($facilitySchedule->status) || $facilitySchedule->status === '')
                                    <x-secondary-button wire:click="markAsOngoing({{ $facilitySchedule->id }})">
                                        <i class="fas fa-hourglass-half mr-1"></i>
                                    </x-secondary-button>
                                @elseif($facilitySchedule->status === 'Ongoing')
                                    <x-secondary-button wire:click="markAsDone({{ $facilitySchedule->id }})">
                                        <i class="fas fa-check mr-1"></i>
                                    </x-secondary-button>
                                @endif

                               
                            </div>

                            </div>
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

    

