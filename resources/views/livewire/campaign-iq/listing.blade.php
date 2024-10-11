<div class="min-w-full align-middle">
    <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.campaign-iq-modal' })" class="mb-4">
        New Supporter
    </x-primary-button>

    <div class="overflow-x-auto"> <!-- Added wrapper for horizontal scrolling -->
        <table class="min-w-full border divide-y divide-gray-200">
            <!-- Table Header -->
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">First Name</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Family Name</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Barangay</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Designation</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50"></th>
                </tr>
            </thead>
            <!-- Table Body -->
            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                @forelse($campaignIqs as $campaignIq)
                    <tr>
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
                            <x-secondary-button wire:click="$dispatch('openModal', { component: 'modals.campaign-iq-modal', arguments: { campaignIq: {{ $campaignIq }} }})">
                                <i class="fas fa-pencil-alt"></i>
                            </x-secondary-button>
                            <x-danger-button wire:click="delete({{ $campaignIq->id }})" onclick="return confirm('Are you sure you want to delete this?')">
                                <i class="fas fa-trash-alt"></i>
                            </x-danger-button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-sm leading-5 text-gray-900">
                            No type available.
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
