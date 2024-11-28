<div class="p-6">
    <div class="flex justify-between items-center mb-4">
        <div class="flex justify-between w-full">
            <!-- Add New Role Button -->
            <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.role-modal', arguments: [] })" class="mr-2">
                Add New Role
            </x-primary-button>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Role Name</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Role Color</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($roles as $role)
                    <tr>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            {{ $role->name }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            <span class="inline-block" style="background-color: {{ $role->color ?? '#e2e8f0' }}; color: {{ $role->color ? '#fff' : '#000' }}; padding: 4px 8px; border-radius: 4px;">
                                {{ $role->color ?? 'No color assigned' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            @hasanyrole('superadmin|admin')
                                <x-secondary-button wire:click="$dispatch('openModal', { component: 'modals.role-modal', arguments: { role: {{ $role }} }})">
                                    <i class="fas fa-pencil-alt"></i>
                                </x-secondary-button>
                            @endhasanyrole
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-sm leading-5 text-gray-900">
                            No roles found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        {{-- Pagination links --}}
        {{ $roles->links() }}
    </div>
</div>
