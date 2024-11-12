<div class="min-w-full align-middle">
    <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.candidate-modal' })" class="mb-4">
        New Barangay
    </x-primary-button>

    <div class="overflow-x-auto"> <!-- Added wrapper for horizontal scrolling -->
        <table class="min-w-full border divide-y divide-gray-200">
            <!-- Table Header -->
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Name</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Position</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50"></th>
                </tr>
            </thead>
            <!-- Table Body -->
            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                @forelse($candidates as $candidate)
                    <tr>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            {{ $candidate->name }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            {{ $candidate->position }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 flex space-x-2">
                            <x-secondary-button wire:click="$dispatch('openModal', { component: 'modals.candidate-modal', arguments: { candidate: {{ $candidate }} }})">
                                <i class="fas fa-pencil-alt"></i>
                            </x-secondary-button>
                            <x-danger-button wire:click="delete({{ $candidate->id }})" onclick="return confirm('Are you sure you want to delete this candidate?')">
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
        {{ $candidates->links() }}
    </div>
</div>
