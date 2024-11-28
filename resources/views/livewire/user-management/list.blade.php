<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <div class="flex items-center ml-auto">
            <select wire:model="selectedRole" class="border p-1 rounded mr-2">
                <option value="">All Roles</option>
                @foreach($roles as $role) 
                    <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option> <!-- Display role name -->
                @endforeach
            </select>
            <input type="text" wire:model="search" class="border p-1 rounded mr-2" placeholder="Search users...">
            <x-primary-button wire:click="searchUsers" class="ml-2">
                Search
            </x-primary-button>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full border divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Name</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Email</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Role</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($users as $user)
                    <tr>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            {{ $user->name }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            {{-- Displaying user roles with dynamic color coding --}}
                            @if($user->roles->isNotEmpty())
                                @foreach($user->roles as $role)
                                    <span class="inline-block text-xs font-semibold mr-2 px-2.5 py-0.5 rounded"
                                          style="background-color: {{ $role->color ?? '#e2e8f0' }}; color: {{ $role->color && !str_starts_with($role->color, '#') ? 'black' : 'white' }};">
                                        {{ $role->name }}
                                    </span>
                                @endforeach
                            @else
                                <span class="text-gray-500">No role</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            @hasanyrole('superadmin|admin')
                                <x-secondary-button wire:click="$dispatch('openModal', { component: 'modals.user-modal', arguments: { user: {{ $user }} }})">
                                    <i class="fas fa-pencil-alt"></i>
                                </x-secondary-button>
                            @endhasanyrole
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-sm leading-5 text-gray-900">
                            No users found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        {{-- Pagination links --}}
        {{ $users->links() }}
    </div>
</div>
