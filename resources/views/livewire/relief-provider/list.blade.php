<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Relief Providers</h2>
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.relief-provider-modal' })">
            <i class="fas fa-plus mr-2"></i> New Provider
        </x-primary-button>
    </div>

    <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
        <x-text-input wire:model.debounce.500ms="search" placeholder="Search providers..." />
        <select wire:model.live="typeFilter" class="rounded-md border-gray-300">
            <option value="">All Types</option>
            <option value="government">Government</option>
            <option value="ngo">NGO</option>
            <option value="private">Private</option>
            <option value="individual">Individual</option>
            <option value="other">Other</option>
        </select>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-900">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Contact</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($providers as $provider)
                    <tr>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $provider->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">{{ $provider->type ? ucfirst($provider->type) : 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">{{ $provider->contact_number ?? 'N/A' }}</td>
                        <td class="px-6 py-4">
                            @if($provider->is_active)
                                <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-800">Active</span>
                            @else
                                <span class="px-2 py-1 text-xs rounded bg-gray-100 text-gray-800">Inactive</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button wire:click="$dispatch('openModal', { component: 'modals.relief-provider-modal', arguments: { provider: {{ $provider->id }} } })" class="text-indigo-600 hover:text-indigo-900">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No providers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4">{{ $providers->links() }}</div>
    </div>
</div>

