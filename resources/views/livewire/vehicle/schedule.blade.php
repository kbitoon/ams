@php
use Carbon\Carbon;
@endphp

<div class="min-w-full align-middle">
    <table class="min-w-full border divide-y divide-gray-200">
        <!-- Table Header -->
        <thead>
        <tr>
            <th class="px-6 py-3 text-left bg-gray-50">
                <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Destination</span>
            </th>
            <th class="px-6 py-3 text-left bg-gray-50">
                <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Start</span>
            </th>
            <th class="px-6 py-3 text-left bg-gray-50">
                <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">End</span>
            </th>
            <th class="px-6 py-3 text-left bg-gray-50">
                <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Vehicle</span>
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
        <!-- Table Body -->
        <tbody class="bg-white divide-y divide-gray-200 divide-solid">
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.vehicleSchedule-modal' })" class="mb-4">
            New Vehicle Schedule
        </x-primary-button>
        
        @forelse($vehicleSchedules as $vehicleSchedule)
            <tr>
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    {{ $vehicleSchedule->destination }}
                </td>
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    {{ $vehicleSchedule->start }}
                </td>
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    {{ $vehicleSchedule->end }}
                </td>
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    {{ $vehicleSchedule->vehicle->name }}
                </td>
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    {{ $vehicleSchedule->driver->name }}
                </td>
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    {{ $vehicleSchedule->status }}
                </td>
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    @if($vehicleSchedule->status !== 'Done')
                        @hasanyrole('superadmin|administrator')
                            <x-secondary-button wire:click="$dispatch('openModal', { component: 'modals.vehicleSchedule-modal', arguments: { vehicleSchedule: {{ $vehicleSchedule }} }})">
                                Edit
                            </x-secondary-button>
                        @endhasanyrole

                        @if($vehicleSchedule->status === 'Ongoing')
                            <x-secondary-button wire:click="markAsDone({{ $vehicleSchedule->id }})">
                                Done
                            </x-secondary-button>
                        @else
                            <x-secondary-button wire:click="markAsOngoing({{ $vehicleSchedule->id }})">
                                Ongoing
                            </x-secondary-button>
                        @endif
                    @endif
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
    <div class="mt-5">
        {{-- Pagination links --}}
        {{ $vehicleSchedules->links() }}
    </div>
</div>
