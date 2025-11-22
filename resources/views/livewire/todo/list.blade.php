<div class="p-6">
    <div class="flex justify-between items-center mb-4 mr-2">
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.todo-modal' })" class="h-8 mr-2">
            <span class="hidden sm:inline">New Task</span>
            <span class="inline sm:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </span>
        </x-primary-button>
    </div>

    <!-- Filters -->
    <div class="mb-4 flex flex-col sm:flex-row flex-wrap gap-4">
        @hasanyrole('superadmin|administrator')
        <div class="flex-1 w-full sm:min-w-[200px]">
            <x-input-label for="userSearch" value="Filter by Assigned User" />
            <div class="relative">
                <input
                    type="text"
                    id="userSearch"
                    wire:model.live.debounce.300ms="userSearch"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    placeholder="Search user by name or email..."
                    autocomplete="off"
                />
                
                @if($filterAssignedUserId)
                    @php
                        $selectedUser = $users->firstWhere('id', $filterAssignedUserId);
                    @endphp
                    @if($selectedUser)
                        <div class="mt-1 text-sm text-gray-600 dark:text-gray-400 flex items-center gap-2">
                            <span>Selected: <span class="font-medium">{{ $selectedUser->name }}</span></span>
                            <button 
                                type="button"
                                wire:click="clearUserFilter"
                                class="text-red-600 hover:text-red-800 font-bold text-lg leading-none"
                                title="Clear selection"
                            >
                                ×
                            </button>
                        </div>
                    @endif
                @endif

                @if($userSearch && $filteredUsers->count() > 0 && !$filterAssignedUserId)
                    <div class="absolute z-50 w-full mt-1 bg-white dark:bg-gray-800 rounded-md shadow-lg border border-gray-200 dark:border-gray-700 max-h-60 overflow-auto">
                        <ul class="py-1">
                            @foreach($filteredUsers as $user)
                                <li>
                                    <button
                                        type="button"
                                        wire:click="selectUser({{ $user->id }})"
                                        class="w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 focus:bg-gray-100 dark:focus:bg-gray-700 focus:outline-none {{ $filterAssignedUserId == $user->id ? 'bg-gray-100 dark:bg-gray-700' : '' }}"
                                    >
                                        <div class="font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</div>
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @elseif($userSearch && $filteredUsers->count() === 0)
                    <div class="absolute z-50 w-full mt-1 bg-white dark:bg-gray-800 rounded-md shadow-lg border border-gray-200 dark:border-gray-700">
                        <div class="px-4 py-2 text-sm text-gray-500 dark:text-gray-400">
                            No users found
                        </div>
                    </div>
                @endif
            </div>
        </div>
        @endhasanyrole

        <div class="flex-1 w-full sm:min-w-[200px]">
            <x-input-label for="filterCompleted" value="Filter by Status" />
            <select 
                id="filterCompleted"
                wire:model.live="filterCompleted" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
            >
                <option value="">All Tasks</option>
                <option value="0">Pending</option>
                <option value="1">Completed</option>
            </select>
        </div>

        @if($filterAssignedUserId || $filterCompleted !== '')
        <div class="w-full sm:w-auto">
            <div class="hidden sm:block h-[21px]"></div>
            <x-secondary-button wire:click="resetFilters" class="h-10 mt-1 w-full sm:w-auto">
                Clear Filters
            </x-secondary-button>
        </div>
        @endif
    </div>

    <!-- Desktop Table View -->
    <div class="hidden md:block overflow-x-auto">
        <table class="min-w-full border divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Task</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Due Date</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Completed</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($todos as $todo)
                    <tr>
                        <td class="px-6 py-4 text-sm leading-5 
                            {{ $todo->is_completed 
                                ? 'text-green-600' 
                                : ($todo->due_date && $todo->due_date < now() ? 'text-red-600' : 'text-gray-900') }}">
                            {{ $todo->task }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            {{ $todo->due_date ? $todo->due_date->format('Y-m-d') : 'Open' }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            @if ($todo->is_completed)
                                <span class="text-sm text-gray-500">
                                    {{ \Carbon\Carbon::parse($todo->updated_at)->subHours(4)->format('Y-m-d') }}
                                </span>
                            @else
                                <span class="text-sm text-gray-500">Pending</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            <div class="relative" x-data="{ showActions: false }">
                                <button 
                                    @click="showActions = !showActions"
                                    class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 focus:outline-none p-1"
                                    type="button"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                                    </svg>
                                </button>
                                
                                <div x-show="showActions"
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="opacity-0 transform scale-95"
                                     x-transition:enter-end="opacity-100 transform scale-100"
                                     x-transition:leave="transition ease-in duration-75"
                                     x-transition:leave-start="opacity-100 transform scale-100"
                                     x-transition:leave-end="opacity-0 transform scale-95"
                                     @click.away="showActions = false"
                                     class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg border border-gray-200 dark:border-gray-700 z-10">
                                    <div class="py-1">
                                        @hasanyrole('superadmin|administrator')
                                            <button 
                                                wire:click="$dispatch('openModal', { component: 'modals.todo-modal', arguments: { todo: {{ $todo->id }} }})"
                                                class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center gap-2"
                                            >
                                                <i class="fas fa-pencil-alt text-gray-500"></i>
                                                <span>Edit</span>
                                            </button>

                                            <button 
                                                x-data
                                                @click="if (confirm('Are you sure you want to delete this?')) { $wire.call('delete', {{ $todo->id }}) }"
                                                class="w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 flex items-center gap-2"
                                            >
                                                <i class="fas fa-trash-alt"></i>
                                                <span>Delete</span>
                                            </button>
                                        @endhasanyrole
                                        
                                        <button 
                                            wire:click="toggleComplete({{ $todo->id }})"
                                            class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center gap-2"
                                        >
                                            @if ($todo->is_completed)
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                                <span>Mark Incomplete</span>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span>Mark Complete</span>
                                            @endif
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-sm leading-5 text-gray-900 text-center">
                            No Task found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Mobile Card View -->
    <div class="md:hidden space-y-4">
        @forelse($todos as $todo)
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm p-4 relative" x-data="{ showActions: false }">
                <!-- Three-dot menu button -->
                <button 
                    @click="showActions = !showActions"
                    class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 focus:outline-none p-1"
                    type="button"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                    </svg>
                </button>

                <div class="space-y-3 pr-8">
                    <!-- Task -->
                    <div>
                        <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Task</div>
                        <div class="text-sm font-medium 
                            {{ $todo->is_completed 
                                ? 'text-green-600 dark:text-green-400' 
                                : ($todo->due_date && $todo->due_date < now() ? 'text-red-600 dark:text-red-400' : 'text-gray-900 dark:text-gray-100') }}">
                            {{ $todo->task }}
                        </div>
                    </div>

                    <!-- Due Date and Status (Side by Side) -->
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Due Date -->
                        <div>
                            <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Due Date</div>
                            <div class="text-sm text-gray-900 dark:text-gray-100">
                                {{ $todo->due_date ? $todo->due_date->format('Y-m-d') : 'Open' }}
                            </div>
                        </div>

                        <!-- Completed Status -->
                        <div>
                            <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Status</div>
                            <div class="text-sm text-gray-900 dark:text-gray-100">
                                @if ($todo->is_completed)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        Completed on {{ \Carbon\Carbon::parse($todo->updated_at)->subHours(4)->format('Y-m-d') }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                        Pending
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons (Hidden by default, shown when menu is clicked) -->
                    <div x-show="showActions" 
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="opacity-100 transform scale-100"
                         x-transition:leave-end="opacity-0 transform scale-95"
                         @click.away="showActions = false"
                         class="pt-2 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex flex-col gap-2">
                            @hasanyrole('superadmin|administrator')
                                <button 
                                    wire:click="$dispatch('openModal', { component: 'modals.todo-modal', arguments: { todo: {{ $todo->id }} }})"
                                    class="text-left px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md transition-colors flex items-center gap-2"
                                >
                                    <i class="fas fa-pencil-alt text-gray-500"></i>
                                    <span>Edit</span>
                                </button>

                                <button 
                                    x-data
                                    @click="if (confirm('Are you sure you want to delete this?')) { $wire.call('delete', {{ $todo->id }}) }"
                                    class="text-left px-3 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-md transition-colors flex items-center gap-2"
                                >
                                    <i class="fas fa-trash-alt"></i>
                                    <span>Delete</span>
                                </button>
                            @endhasanyrole
                            
                            <button 
                                wire:click="toggleComplete({{ $todo->id }})"
                                class="text-left px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md transition-colors flex items-center gap-2"
                            >
                                @if ($todo->is_completed)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    <span>Mark Incomplete</span>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span>Mark Complete</span>
                                @endif
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm p-6 text-center">
                <p class="text-sm text-gray-900 dark:text-gray-100">No Task found.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-5">
        {{-- Pagination links --}}
        {{ $todos->links() }}
    </div>
</div>
