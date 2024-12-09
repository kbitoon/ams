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

    <div class="overflow-x-auto">
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
                                : ($todo-4>due_date && $todo->due_date < now() ? 'text-red-600' : 'text-gray-900') }}">
                            {{ $todo->task }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            {{ ($todo->assignedUser->name ?? '') . (($todo->assignedUser && $todo->role) ? ' & ' : '') . ($todo->role->name ?? '') ?: 'N/A' }}
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
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 flex gap-2">
                            @hasanyrole('superadmin|administrator')
                                <x-secondary-button wire:click="$dispatch('openModal', { component: 'modals.todo-modal', arguments: { todo: {{ $todo->id }} }})">
                                    <i class="fas fa-pencil-alt"></i>
                                </x-secondary-button>

                                <x-danger-button wire:click="delete({{ $todo->id }})"  onclick="return confirm('Are you sure you want to delete this?') ">
                                    <i class="fas fa-trash-alt"></i>
                                </x-danger-button>

                            @endhasanyrole
                                <x-secondary-button wire:click="toggleComplete({{ $todo->id }})">
                                    @if ($todo->is_completed)
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                        </svg>
                                    @endif
                                </x-secondary-button>
                            
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-sm leading-5 text-gray-900">
                            No Task found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        {{-- Pagination links --}}
        {{ $todos->links() }}
    </div>
</div>
