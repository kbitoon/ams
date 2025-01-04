<div class="bg-white overflow-hidden sm:rounded-lg">
    <div class="flex justify-between items-center mb-4 mr-2 mt-2 ml-2">
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.vehicleSchedule-modal' })" class="h-8 mr-2">
            <span class="hidden sm:inline">New Vehicle Schedule</span>
            <span class="inline sm:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </span>
        </x-primary-button>
    </div>
    <div class="p-6 text-gray-900">
        <div x-data="{ openTab: 1 }">
            <!-- Conditionally Render Tab Buttons -->
            @hasanyrole('superadmin|administrator|support')
            <div class="flex space-x-4 border-b">
                <button 
                    :class="openTab === 1 ? 'border-b-2 font-medium text-blue-500' : 'text-gray-500'" 
                    @click="openTab = 1" 
                    class="py-2 px-4">
                    Calendar View
                </button>
                <button 
                    :class="openTab === 2 ? 'border-b-2 font-medium text-blue-500' : 'text-gray-500'" 
                    @click="openTab = 2" 
                    class="py-2 px-4">
                    List View
                </button>
            </div>
            @endhasanyrole

            <!-- Tab Content -->
            <div x-show="openTab === 1 && @json(auth()->user()->hasAnyRole(['superadmin', 'administrator', 'support']))" class="mt-4">
                <livewire:vehicle-calendar />
            </div>
            <div x-show="openTab === 2 || !@json(auth()->user()->hasAnyRole(['superadmin', 'administrator', 'support']))" class="mt-4">
                <!-- Vehicle Schedule Section -->
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
                                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Name</span>
                                    </th>
                                    <th class="px-6 py-3 text-left bg-gray-50">
                                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Destination</span>
                                    </th>
                                    <th class="px-6 py-3 text-left bg-gray-50">
                                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Driver</span>
                                    </th>
                                    @hasanyrole('superadmin|administrator|support')
                                    <th class="px-6 py-3 text-left bg-gray-50">
                                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Status</span>
                                    </th>
                                    @endhasanyrole
                                    <th class="px-6 py-3 text-left bg-gray-50"></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($vehicleSchedules as $vehicleSchedule)
                                    <tr>
                                        <!-- Start Date -->
                                        <td class="px-6 py-4 text-sm leading-5 {{ $vehicleSchedule->is_approved ? 'text-gray-900' : 'text-red-500' }}">
                                            {{ $vehicleSchedule->formatted_start }}
                                        </td>
                                        <!-- Vehicle -->
                                        <td class="px-6 py-4 text-sm leading-5 {{ $vehicleSchedule->is_approved ? 'text-gray-900' : 'text-red-500' }}">
                                            {{ $vehicleSchedule->vehicle->name }}
                                        </td>
                                        <!-- End Date -->
                                        <td class="px-6 py-4 text-sm leading-5 {{ $vehicleSchedule->is_approved ? 'text-gray-900' : 'text-red-500' }}">
                                            {{ $vehicleSchedule->formatted_end }}
                                        </td>
                                        <td class="px-6 py-4 text-sm leading-5 {{ $vehicleSchedule->is_approved ? 'text-gray-900' : 'text-red-500' }}">
                                            {{ $vehicleSchedule->name }}
                                        </td>
                                        <!-- Destination -->
                                        <td class="px-6 py-4 text-sm leading-5 {{ $vehicleSchedule->is_approved ? 'text-gray-900' : 'text-red-500' }}">
                                            {{ $vehicleSchedule->destination }}
                                        </td>
                                        <!-- Driver -->
                                        <td class="px-6 py-4 text-sm leading-5 {{ $vehicleSchedule->is_approved ? 'text-gray-900' : 'text-red-500' }}">
                                            {{ $vehicleSchedule->driver->name ?? 'No Driver Assigned' }}
                                        </td>
                                        <!-- Status -->
                                        @hasanyrole('superadmin|administrator|support')
                                        <td class="px-6 py-4 text-sm leading-5 {{ $vehicleSchedule->is_approved ? 'text-gray-900' : 'text-red-500' }}">
                                            {{ $vehicleSchedule->status }}
                                        </td>
                                        @endhasanyrole
                                        <!-- Approve Button -->
                                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                                            <div class="flex items-center space-x-2">
                                                
                                                <x-secondary-button wire:click="$dispatch('openModal', { component: 'modals.vehicleSchedule-modal', arguments: { vehicleSchedule: {{ $vehicleSchedule }} }})">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </x-secondary-button>
                                                @hasanyrole('superadmin|administrator|support')
                                                    <x-danger-button wire:click.stop="delete({{ $vehicleSchedule->id }})" onclick="return confirm('Are you sure you want to delete this?')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </x-danger-button>
                                                   
                                               
                                                @if(is_null($vehicleSchedule->status) || $vehicleSchedule->status === '')
                                                    <x-secondary-button wire:click="markAsOngoing({{ $vehicleSchedule->id }})">
                                                        <i class="fas fa-hourglass-half mr-1"></i>
                                                    </x-secondary-button>
                                                @elseif($vehicleSchedule->status === 'Ongoing')
                                                    <x-secondary-button wire:click="markAsDone({{ $vehicleSchedule->id }})">
                                                        <i class="fas fa-check mr-1"></i>
                                                    </x-secondary-button>
                                                @endif

                                                @if(!$vehicleSchedule->is_approved)
                                                    <x-primary-button wire:click="approve({{ $vehicleSchedule->id }})">
                                                        Approve
                                                    </x-primary-button>
                                                    @endif
                                                @endhasanyrole
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
            </div>
        </div>
    </div>
</div>
