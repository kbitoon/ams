<div class="p-6">
    <!-- Table Section -->
    <div class="flex justify-between items-center mb-4 mr-2">
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.lupon-case-modal' })"
            class="h-8 mr-2">
            <span class="hidden sm:inline">New Case</span>
            <span class="inline sm:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
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
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Date</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Status</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Closed</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($luponCases as $luponCase)
                    <tr class="hover:bg-gray-100 cursor-pointer"
                        wire:click="$dispatch('openModal', { component: 'modals.show.luponCase-modal', arguments: { luponCase: {{ $luponCase }} }})">
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            {{ $luponCase->date }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 capitalize">
                            {{ $luponCase->status }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 capitalize">
                        {{ \Carbon\Carbon::parse($luponCase->end)->format('M j, Y') }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                           
                            @if(is_null($luponCase->blotter_id))
                                <x-secondary-button
                                    wire:click.stop="$dispatch('openModal', { component: 'modals.lupon-case-complainant-modal', arguments: { 'lupon_case_id': {{ $luponCase->id }} }})"
                                    class="relative group">
                                    <i class="fas fa-user-plus"></i>
                                    <span
                                        class="absolute -top-8 left-1/2 -translate-x-1/2 scale-0 transition-all group-hover:scale-100 bg-gray-700 text-white text-xs rounded py-1 px-2">
                                        Add a Complainant
                                    </span>
                                </x-secondary-button>
                                <x-secondary-button
                                    wire:click.stop="$dispatch('openModal', { component: 'modals.lupon-case-respondent-modal', arguments: { lupon_case_id: {{ $luponCase->id }} }})"
                                    class="relative group">
                                    <i class="fas fa-user-friends"></i>
                                    <span
                                        class="absolute -top-8 left-1/2 -translate-x-1/2 scale-0 transition-all group-hover:scale-100 bg-gray-700 text-white text-xs rounded py-1 px-2">
                                        Add a Respondent
                                    </span>
                                </x-secondary-button>
                            @endif
                                <x-secondary-button
                                    wire:click.stop="$dispatch('openModal', { component: 'modals.lupon-summon-tracking-modal', arguments: { lupon_case_id: {{ $luponCase->id }} }})"
                                    class="relative group">
                                    <i class="fas fa-clipboard-list"></i>
                                    <span
                                        class="absolute -top-8 left-1/2 -translate-x-1/2 scale-0 transition-all group-hover:scale-100 bg-gray-700 text-white text-xs rounded py-1 px-2">
                                        Add Summon
                                    </span>
                                </x-secondary-button>
                                <x-secondary-button
                                    wire:click.stop="$dispatch('openModal', { component: 'modals.lupon-hearing-tracking-modal', arguments: { lupon_case_id: {{ $luponCase->id }} }})"
                                    class="relative group">
                                    <i class="fas fa-gavel"></i>
                                    <span
                                        class="absolute -top-8 left-1/2 -translate-x-1/2 scale-0 transition-all group-hover:scale-100 bg-gray-700 text-white text-xs rounded py-1 px-2">
                                        Add Hearing
                                    </span>
                                </x-secondary-button>
                                <x-secondary-button
                                    wire:click.stop="$dispatch('openModal', { component: 'modals.luponCase-modal', arguments: { luponCase: {{ $luponCase->id }} }})">
                                    <i class="fas fa-pencil-alt"></i>
                                </x-secondary-button>
                                <x-danger-button wire:click.stop="delete({{ $luponCase->id }})"
                                    onclick="return confirm('Are you sure you want to delete this?')">
                                    <i class="fas fa-trash-alt"></i>
                                </x-danger-button>
                        </td>
                            
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-sm leading-5 text-gray-900">
                            No Cases found.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    <div class="mt-5">
        {{-- Pagination links --}}
        {{ $luponCases->links() }}
    </div>