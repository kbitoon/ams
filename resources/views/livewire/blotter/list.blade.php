<div class="p-6">
    <!-- Table Section -->
    <div class="flex justify-between items-center mb-4 mr-2">
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.blotter-modal' })" class="h-8 mr-2">
            <span class="hidden sm:inline">New Blotter</span>
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
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Id</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Date of Incident</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Date of Reported</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Complainant</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Respondent</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($blotters as $blotter)
                <tr class="hover:bg-gray-100 cursor-pointer"
                wire:click="$dispatch('openModal', { component: 'modals.show.blotter-modal', arguments: { blotter: {{ $blotter }} }})">
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            {{$blotter->id }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                        {{ \Carbon\Carbon::parse($blotter->incident)->format('M j, Y g:i A') }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                        {{ \Carbon\Carbon::parse($blotter->reported)->format('M j, Y g:i A') }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                        {{ trim("{$blotter->firstname} {$blotter->lastname}") }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                        {{ optional($blotter->complainee)->first ?? 'N/A' }} {{ optional($blotter->complainee)->last ?? '' }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            @hasanyrole('superadmin|administrator')
                                <x-secondary-button wire:click.stop="$dispatch('openModal', { component: 'modals.blotter-modal', arguments: { blotter: {{ $blotter->id }} }})">
                                    <i class="fas fa-pencil-alt"></i>
                                </x-secondary-button>
                                @hasanyrole('superadmin')
                                    <x-danger-button wire:click.stop="delete({{ $blotter->id }})" onclick="return confirm('Are you sure you want to delete this?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </x-danger-button>
                                @endhasanyrole  
                                @if (is_null($blotter->complainee_id))
                                    <x-secondary-button wire:click.stop="$dispatch('openModal', { component: 'modals.complainee-modal', arguments: { blotter: {{ $blotter->id }} }})">
                                        <i class="fas fa-user-plus"></i>
                                    </x-secondary-button>
                                @endif
                            @endhasanyrole 
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-sm leading-5 text-gray-900">
                            No blotters found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        {{-- Pagination links --}}
        {{ $blotters->links() }}
    </div>

    

