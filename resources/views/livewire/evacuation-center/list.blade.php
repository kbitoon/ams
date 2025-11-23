<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Evacuation Centers</h2>
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.evacuation-center-modal' })">
            <i class="fas fa-plus mr-2"></i> New Center
        </x-primary-button>
    </div>

    <div class="mb-4">
        <x-text-input wire:model.debounce.500ms="search" class="w-full" placeholder="Search centers by name or address..." />
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-900">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Address</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Capacity</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Contact</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($centers as $center)
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-gray-100">{{ $center->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">{{ Str::limit($center->address, 50) }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ number_format($center->capacity) }} persons</td>
                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                            @if($center->contactPerson)
                                {{ $center->contactPerson->name }}
                            @elseif($center->contact_number)
                                {{ $center->contact_number }}
                            @else
                                <span class="text-gray-400">N/A</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-medium">
                            <button wire:click="$dispatch('openModal', { component: 'modals.evacuation-center-modal', arguments: { center: {{ $center->id }} } })" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">No evacuation centers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4">{{ $centers->links() }}</div>
    </div>
</div>

