<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Disaster Response Teams</h2>
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.disaster-response-team-modal' })">
            <i class="fas fa-plus mr-2"></i> New Team
        </x-primary-button>
    </div>

    <div class="mb-4">
        <x-text-input wire:model.debounce.500ms="search" class="w-full" placeholder="Search teams..." />
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-900">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Team Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Leader</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Members</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($teams as $team)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $team->name }}</div>
                            @if($team->description)
                                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ Str::limit($team->description, 50) }}</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">
                            {{ $team->teamLeader->name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                            {{ $team->active_members_count }} {{ Str::plural('member', $team->active_members_count) }}
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-medium">
                            <button wire:click="$dispatch('openModal', { component: 'modals.disaster-response-team-modal', arguments: { team: {{ $team->id }} } })" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">No response teams found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4">{{ $teams->links() }}</div>
    </div>
</div>

