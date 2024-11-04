<div class="p-6">

    <!-- Filters Section -->
    <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-3">
        <!-- Date Filter -->
        <div>
            <label for="dateFilter" class="block text-sm font-medium text-gray-700">Filter by Date</label>
            <input type="date" id="dateFilter" wire:model.defer="tempDateFilter" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <!-- Vehicle Filter -->
        <div>
            <label for="vehicleFilter" class="block text-sm font-medium text-gray-700">Filter by Vehicle</label>
            <select id="vehicleFilter" wire:model.defer="tempVehicleFilter" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">All Vehicles</option>
                @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
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

    <!-- Filter Button -->
    <div class="mb-4 flex justify-center md:justify-end space-x-2">

        <x-primary-button wire:click="applyFilters">
            Apply Filters
        </x-primary-button>
    </div>

    <div class="mb-4 flex justify-center md:justify-start space-x-2">
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.vehicleSchedule-modal' })">
                    New Vehicle Schedule
        </x-primary-button>
    </div>  
    
    <!-- Schedule Table -->
    <div class="overflow-x-auto mt-5">
        <table class="min-w-full border divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Start</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Vehicle</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">End</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Destination</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Driver</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Status</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($vehicleSchedules as $vehicleSchedule)
                    <tr>
                        
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            {{ $vehicleSchedule->formatted_start }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 ">
                            {{ $vehicleSchedule->vehicle->name }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            {{ $vehicleSchedule->formatted_end }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            {{ $vehicleSchedule->destination }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                        {{ $vehicleSchedule->driver->name ?? 'No Driver Assigned' }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            {{ $vehicleSchedule->status }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            <div class="flex items-center space-x-2">
                                @if($vehicleSchedule->status === '')
                                    @hasanyrole('superadmin|administrator|support')
                                        <x-secondary-button wire:click="$dispatch('openModal', { component: 'modals.vehicleSchedule-modal', arguments: { vehicleSchedule: {{ $vehicleSchedule }} }})">
                                            <i class="fas fa-pencil-alt"></i>
                                        </x-secondary-button>
                                    @endhasanyrole

                                    @if($vehicleSchedule->status === 'Ongoing')
                                        <x-secondary-button wire:click="markAsDone({{ $vehicleSchedule->id }})">
                                            <i class="fas fa-check mr-1"></i>
                                        </x-secondary-button>
                                    @else
                                        <x-secondary-button wire:click="markAsOngoing({{ $vehicleSchedule->id }})">
                                            <i class="fas fa-hourglass-half mr-1"></i>
                                        </x-secondary-button>
                                    @endif
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 text-sm leading-5 text-gray-900">
                            No upcoming vehicle schedules.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        {{ $vehicleSchedules->links() }}
    </div>
</div>
