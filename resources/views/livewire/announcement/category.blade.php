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
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.announcement-category-modal' })" class="mb-4">
            New Announcement Category
        </x-primary-button>
        @forelse($announcementCategories as $announcementCategory)
            <tr>
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    {{ $announcementCategory->name }}
                </td>
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    <x-secondary-button wire:click="$dispatch('openModal', { component: 'modals.announcement-category-modal', arguments: { announcementCategory: {{ $announcementCategory }} }})">
                    <i class="fas fa-pencil-alt"></i>
                    </x-secondary-button>
                    <x-danger-button x-data @click="if (confirm('Are you sure you want to delete this?')) { $wire.call('delete', {{ $announcementCategory->id }}) }">
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
        {{ $announcementCategories->links() }}
    </div>
</div>

