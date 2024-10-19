<div class="min-w-full align-middle overflow-x-auto">
    <table class="min-w-full border divide-y divide-gray-200">
        <!-- Table Header -->
        <thead>
            <tr>
                <th class="px-6 py-3 text-left bg-gray-50">
                    <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Group</span>
                </th>
                <th class="px-6 py-3 text-left bg-gray-50">
                    <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Total</span>
                </th>
                <th class="px-6 py-3 text-left bg-gray-50"></th>
            </tr>
        </thead>
        <!-- Table Body -->
        <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                        
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.user-statistics-modal' })" class="mb-4">
            New User Statistics
        </x-primary-button>
            @forelse($statistics as $userStatistics)
                <tr>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                        {{ $userStatistics->group }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                        {{ $userStatistics->total }}
                    </td>
                    <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                        <div class="flex space-x-2">
                            <x-secondary-button wire:click="$dispatch('openModal', { component: 'modals.user-statistics-modal', arguments: { userStatistics: {{ $userStatistics }} }})">
                                <i class="fas fa-pencil-alt"></i>
                            </x-secondary-button>
                            <x-danger-button wire:click="delete({{ $userStatistics->id }})" onclick="return confirm('Are you sure you want to delete this clearance type?')">
                                <i class="fas fa-trash-alt"></i>
                            </x-danger-button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-sm leading-5 text-gray-900 text-center">
                        No user statistics available.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-5">
        {{-- Pagination links --}}
        {{ $statistics->links() }}
    </div>
</div>
