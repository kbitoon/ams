<div class="min-w-full align-middle">
    <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-3">
        <!-- Date Filter -->
        <div>
            <label for="dateFilter" class="block text-sm font-medium text-gray-700">Filter by Date</label>
            <input type="date" id="dateFilter" wire:model.defer="tempDateFilter" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <!-- District Filter -->
        <div>
            <label for="districtFilter" class="block text-sm font-medium text-gray-700">Filter by District</label>
            <select id="districtFilter" wire:model.defer="tempDistrictFilter" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="">All District</option>
                <option value="North">North</option>
                <option value="South">South</option>
            </select>
        </div>

        <div class="flex items-end space-x-2">
            <input type="text" wire:model="search" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Search...">
            
            <x-primary-button wire:click="applyFilters" class="h-10">
                Search
            </x-primary-button>
        </div>
    </div>

    <div class="flex justify-between items-center mb-4">
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.activity-modal' })" class="h-8 mr-2">
            <span class="hidden sm:inline">New Activity</span>
            <span class="inline sm:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </span>
        </x-primary-button>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border divide-y divide-gray-200">
            <!-- Table Header -->
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Date</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Description</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Location</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Barangay</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50"></th>
                </tr>
            </thead>
            <!-- Table Body -->
            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                @forelse($activities as $activity)
                <tr class="hover:bg-gray-100 cursor-pointer" 
                    wire:click="$dispatch('openModal', { component: 'modals.show.activity-modal', arguments: { activity: {{ $activity }} }})">
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                        {{ $activity->date }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                        {{ $activity->description }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                        {{ $activity->location }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                        {{ $activity->barangayList->barangay }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 flex space-x-2">
                        <x-secondary-button wire:click.stop="$dispatch('openModal', { component: 'modals.activity-modal', arguments: { activity: {{ $activity }} }})">
                            <i class="fas fa-pencil-alt"></i>
                        </x-secondary-button>
                        <x-danger-button wire:click.stop="delete({{ $activity->id }})" onclick="return confirm('Are you sure you want to delete this?')">
                            <i class="fas fa-trash-alt"></i>
                        </x-danger-button>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-sm leading-5 text-gray-900">
                            No activity available.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div> <!-- End of wrapper for scrolling -->

    <div class="mt-5">
        {{-- Pagination links --}}
        {{ $activities->links() }}
    </div>
</div>
