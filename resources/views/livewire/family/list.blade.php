<div>
    <div class="flex justify-between items-center mb-4">
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.family-modal' })">
            <i class="fas fa-plus mr-2"></i> New Family
        </x-primary-button>
    </div>

    <div class="mb-4">
        <x-text-input wire:model.debounce.500ms="search" class="w-full" placeholder="Search by family name or head of family..." />
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-900">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Family</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Head of Family</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Members</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Address</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($families as $family)
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $family->family_name ?? 'Unnamed Family' }}</td>
                        <td class="px-6 py-4 text-sm">
                            <button 
                                wire:click="$dispatch('openModal', { component: 'modals.show.user-modal', arguments: { user: {{ $family->headOfFamily->id }} }})"
                                class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 hover:underline font-medium"
                                title="View Head of Family Profile"
                            >
                                {{ $family->headOfFamily->name }}
                            </button>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <button 
                                wire:click="$dispatch('openModal', { component: 'modals.family-members-modal', arguments: { family: {{ $family->id }} } })"
                                class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 hover:underline font-medium"
                                title="View Family Members"
                            >
                                {{ $family->members_count }} {{ Str::plural('member', $family->members_count) }}
                            </button>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">{{ $family->address ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-right text-sm font-medium">
                            <button 
                                wire:click="$dispatch('openModal', { component: 'modals.family-modal', arguments: { family: {{ $family->id }} } })" 
                                class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 mr-3"
                                title="Edit Family & Manage Members"
                            >
                                <i class="fas fa-edit"></i> Edit
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No families found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4">{{ $families->links() }}</div>
    </div>
</div>

