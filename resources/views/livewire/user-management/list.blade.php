<div class="space-y-6">
    <!-- Filters Section -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4 sm:p-6">
        <div class="flex flex-col sm:flex-row gap-4 items-end">
            <div class="flex-1 w-full sm:w-auto">
                <label for="role-filter" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Filter by Role</label>
                <select wire:model.live="selectedRole" id="role-filter" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">All Roles</option>
                    @foreach($roles as $role) 
                        <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex-1 w-full sm:w-auto">
                <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Search Users</label>
                <div class="flex gap-2">
                    <input type="text" wire:model.live.debounce.300ms="search" id="search" class="flex-1 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Search by name...">
                </div>
            </div>
        </div>
    </div>

    <!-- Desktop Table View -->
    <div class="hidden md:block bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-900">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($users as $user)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button 
                                    wire:click="$dispatch('openModal', { component: 'modals.show.user-modal', arguments: { user: {{ $user }} }})"
                                    class="text-sm font-medium text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 hover:underline">
                                    {{ $user->name }}
                                </button>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900 dark:text-gray-100">{{ $user->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($user->roles->isNotEmpty())
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($user->roles as $role)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium"
                                                  style="background-color: {{ $role->color ?? '#e2e8f0' }}; color: {{ $role->color && !str_starts_with($role->color, '#') ? 'black' : 'white' }};">
                                                {{ ucfirst($role->name) }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-sm text-gray-500 dark:text-gray-400">No role</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-2">
                                    @hasanyrole('superadmin|administrator|support')
                                        <a 
                                            href="{{ route('id-card.download.user', $user->id) }}"
                                            target="_blank"
                                            class="text-green-600 dark:text-green-400 hover:text-green-900 dark:hover:text-green-300"
                                            title="Download QR Code">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.5v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 19.5v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 4.5h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 10.5h-4.5m4.5 0v-4.5m0 4.5L15 15" />
                                            </svg>
                                        </a>
                                    @endhasanyrole
                                    @hasanyrole('superadmin|administrator')
                                        <button 
                                            wire:click="$dispatch('openModal', { component: 'modals.user-modal', arguments: { user: {{ $user->id }} }})"
                                            class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                        </button>
                                    @endhasanyrole
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No users found</h3>
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Try adjusting your search or filter criteria.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Mobile Card View -->
    <div class="md:hidden space-y-4">
        @forelse($users as $user)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4">
                <div class="flex items-start justify-between">
                    <div class="flex-1 min-w-0">
                        <button 
                            wire:click="$dispatch('openModal', { component: 'modals.show.user-modal', arguments: { user: {{ $user }} }})"
                            class="text-base font-semibold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 hover:underline truncate block w-full text-left">
                            {{ $user->name }}
                        </button>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1 truncate">{{ $user->email }}</p>
                        <div class="mt-2 flex flex-wrap gap-1">
                            @if($user->roles->isNotEmpty())
                                @foreach($user->roles as $role)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium"
                                          style="background-color: {{ $role->color ?? '#e2e8f0' }}; color: {{ $role->color && !str_starts_with($role->color, '#') ? 'black' : 'white' }};">
                                        {{ ucfirst($role->name) }}
                                    </span>
                                @endforeach
                            @else
                                <span class="text-xs text-gray-500 dark:text-gray-400">No role</span>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center gap-2 ml-2">
                        @hasanyrole('superadmin|administrator|support')
                            <a 
                                href="{{ route('id-card.download.user', $user->id) }}"
                                target="_blank"
                                class="p-2 text-green-600 dark:text-green-400 hover:text-green-900 dark:hover:text-green-300 flex-shrink-0"
                                title="Download QR Code">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.5v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 19.5v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 4.5h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 10.5h-4.5m4.5 0v-4.5m0 4.5L15 15" />
                                </svg>
                            </a>
                        @endhasanyrole
                        @hasanyrole('superadmin|administrator')
                            <button 
                                wire:click="$dispatch('openModal', { component: 'modals.user-modal', arguments: { user: {{ $user->id }} }})"
                                class="p-2 text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </button>
                        @endhasanyrole
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No users found</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Try adjusting your search or filter criteria.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($users->hasPages())
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 p-4">
        {{ $users->links() }}
    </div>
    @endif
</div>
