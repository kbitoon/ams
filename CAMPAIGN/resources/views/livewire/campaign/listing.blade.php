
<div class="min-w-full align-middle">
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
            <div class="bg-white shadow-md rounded-md p-4 border border-gray-200">
                <p class="text-lg font-semibold text-black dark:text-white">Total Supporter</p>
                <span class="text-2xl font-extrabold text-[#FF2D20]">{{ $totalSupporter }}</span>
            </div>

            <div class="bg-white shadow-md rounded-md p-4 border border-gray-200">
                <p class="text-lg font-semibold text-black dark:text-white">Total Leaders</p>
                <span class="text-2xl font-extrabold text-[#FF2D20]">{{ $totalLeaders }}</span>
            </div>


            <div class="bg-white shadow-md rounded-md p-4 border border-gray-200">
                <p class="text-lg font-semibold text-black dark:text-white">Total Coordinators</p>
                <span class="text-2xl font-extrabold text-[#FF2D20]">{{ $totalCoordinators }}</span>
            </div>

            <div class="bg-white shadow-md rounded-md p-4 border border-gray-200">
            <p class="text-lg font-semibold text-black dark:text-white">Barangay Captains</p>
            <span class="text-2xl font-extrabold text-[#FF2D20]">{{ $totalBarangayCaptains }} <span class="text-sm font-normal text-black">out of</span> {{ $totalBarangays }} <span class="text-sm font-normal text-black">Barangays</span></span>
    </div>
</div>


    <div class="flex justify-between items-center mb-4">

                <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.campaignIq-modal' })" class="h-8 mr-2">
                    <span class="hidden sm:inline">New Supporter</span>
                    <span class="inline sm:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </span>
                </x-primary-button>


        <div class="flex items-center space-x-2">

            <input type="text" wire:model="search" class="border p-1 rounded h-8 w-full sm:w-32" placeholder="Search...">

            <select wire:model="filter" class="border p-1 rounded h-8 w-full sm:w-32">
                <option value="">All Barangays</option>
                @foreach($barangays as $barangay)
                    <option value="{{ $barangay }}">{{ $barangay }}</option>
                @endforeach
            </select>

            <x-primary-button wire:click="searchItems" class="h-8">
                <span class="hidden sm:inline">Search</span>
                <span class="sm:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.9 14.32a8 8 0 111.41-1.41l3.9 3.9a1 1 0 11-1.42 1.42l-3.9-3.9zM8 14A6 6 0 108 2a6 6 0 000 12z" clip-rule="evenodd" />
                    </svg>
                </span>
            </x-primary-button>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border divide-y divide-gray-200">
            <!-- Table Header -->
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left bg-gray-50 cursor-pointer">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">First Name</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50 cursor-pointer" wire:click="sortBy('familyname')">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Last Name</span>
                        @if($sortField == 'familyname')
                            <span>{{ $sortDirection == 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50 cursor-pointer" wire:click="sortBy('barangay')">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Barangay</span>
                        @if($sortField == 'barangay')
                            <span>{{ $sortDirection == 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50 cursor-pointer" wire:click="sortBy('designation')">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Designation</span>
                        @if($sortField == 'designation')
                            <span>{{ $sortDirection == 'asc' ? '↑' : '↓' }}</span>
                        @endif
                    </th>
                        <th class="px-6 py-3 text-left bg-gray-50"></th>
                </tr>
            </thead>
            <!-- Table Body -->
            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                @forelse($campaignIqs as $campaignIq)
                <tr class="hover:bg-gray-100 cursor-pointer" 
                    wire:click="$dispatch('openModal', { component: 'modals.show.campaign-iq-modal', arguments: { campaignIq: {{ $campaignIq }} }})">
                    <!-- Make the entire row clickable -->
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                        {{ $campaignIq->firstname }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                        {{ $campaignIq->familyname }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                        {{ $campaignIq->barangay }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                        {{ $campaignIq->designation }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900 flex space-x-2">
                        <x-secondary-button wire:click.stop="$dispatch('openModal', { component: 'modals.campaign-iq-modal', arguments: { campaignIq: {{ $campaignIq }} }})">
                            <i class="fas fa-pencil-alt"></i>
                        </x-secondary-button>
                        <x-danger-button wire:click.stop="delete({{ $campaignIq->id }})" onclick="return confirm('Are you sure you want to delete this?')">
                            <i class="fas fa-trash-alt"></i>
                        </x-danger-button>
                        @if($campaignIq->status <> 'Paid')
                        <x-secondary-button wire:click.stop="markAsPaid({{ $campaignIq->id }})" class="flex items-center">
                                    <i class="fas fa-check mr-1"></i>
                        </x-secondary-button>
                        @endif
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-sm leading-5 text-gray-900">
                            No supporters available.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div> <!-- End of wrapper for scrolling -->
    
    <div class="mt-5">
        {{-- Pagination links --}}
        {{ $campaignIqs->links() }}
    </div>
</div>
