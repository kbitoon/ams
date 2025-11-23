<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Preparedness Checklists</h2>
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.preparedness-checklist-modal' })">
            <i class="fas fa-plus mr-2"></i> New Checklist
        </x-primary-button>
    </div>

    <!-- Filters -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="search" value="Search" />
                <x-text-input wire:model.debounce.500ms="search" id="search" class="mt-1 block w-full" placeholder="Search checklists..." />
            </div>
            <div>
                <x-input-label for="typeFilter" value="Disaster Type" />
                <select wire:model.live="typeFilter" id="typeFilter" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="">All Types</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @if($search || $typeFilter)
            <div class="mt-4">
                <x-secondary-button wire:click="resetFilters" size="sm">Clear Filters</x-secondary-button>
            </div>
        @endif
    </div>

    <!-- Checklists List -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-900">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Disaster Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Items</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($checklists as $checklist)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $checklist->title }}</div>
                                @if($checklist->description)
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ Str::limit($checklist->description, 50) }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                                {{ $checklist->disasterType->name }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                                {{ $checklist->items->count() }} items
                            </td>
                            <td class="px-6 py-4 text-right text-sm font-medium">
                                <button wire:click="$dispatch('openModal', { component: 'modals.preparedness-checklist-modal', arguments: { checklist: {{ $checklist->id }} } })" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 mr-3">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button wire:click="$dispatch('openModal', { component: 'modals.checklist-completion-modal', arguments: { checklist: {{ $checklist->id }} } })" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300" title="Complete Checklist">
                                    <i class="fas fa-check-square"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">No checklists found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
            {{ $checklists->links() }}
        </div>
    </div>
</div>

