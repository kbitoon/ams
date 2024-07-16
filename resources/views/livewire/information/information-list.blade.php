<div class="min-w-full align-middle">
    <table class="min-w-full border divide-y divide-gray-200">
        <!-- Table Header -->
        <thead>
        <tr>
            <th class="px-6 py-3 text-left bg-gray-50">
                <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Title</span>
            </th>
            <th class="px-6 py-3 text-left bg-gray-50"></th>
        </tr>
        </thead>
        <!-- Table Body -->
        <tbody class="bg-white divide-y divide-gray-200 divide-solid">
        @hasanyrole('superadmin|administrator')
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.information-modal' })" class="mb-4">
            New Information
        </x-primary-button>
        @endhasanyrole
        @forelse($informations as $information)
            <tr>
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    {{ $information->title }}
                </td>
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    @hasanyrole('superadmin|administrator')
                    <x-secondary-button wire:click="$dispatch('openModal', { component: 'modals.information-modal', arguments: { information: {{ $information }} }})">
                        Edit
                    </x-secondary-button>
                    @endhasanyrole
                    <x-secondary-button wire:click="$dispatch('openModal', { component: 'modals.show.information-modal', arguments: { information: {{ $information }} }})">
                        View
                    </x-secondary-button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="px-6 py-4 text-sm leading-5 text-gray-900">
                    No information available.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div class="mt-5">
        {{-- Pagination links --}}
        {{ $informations->links() }}
    </div>
</div>

