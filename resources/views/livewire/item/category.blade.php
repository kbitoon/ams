<div class="min-w-full align-middle">
    <table class="min-w-full border divide-y divide-gray-200">
        <!-- Table Header -->
        <thead>
        <tr>
            <th class="px-6 py-3 text-left bg-gray-50">
                <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Name</span>
            </th>
            <th class="px-6 py-3 text-left bg-gray-50"></th>
        </tr>
        </thead>
        <!-- Table Body -->
        <tbody class="bg-white divide-y divide-gray-200 divide-solid">
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.item-category-modal' })" class="mb-4">
            New Item Category
        </x-primary-button>
        @forelse($itemCategories as $itemCategory)
            <tr>
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    {{ $itemCategory->name }}
                </td>
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    <x-secondary-button wire:click="$dispatch('openModal', { component: 'modals.item-category-modal', arguments: { itemCategory: {{ $itemCategory }} }})">
                    <i class="fas fa-pencil-alt"></i>
                    </x-secondary-button>
                    <x-danger-button wire:click="delete({{ $itemCategory->id }})" onclick="return confirm('Are you sure you want to delete this clearance type?')">
                    <i class="fas fa-trash-alt"></i>
                    </x-danger-button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="px-6 py-4 text-sm leading-5 text-gray-900">
                    No category available.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div class="mt-5">
        {{-- Pagination links --}}
        {{ $itemCategories->links() }}
    </div>
</div>

