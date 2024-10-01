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
        <div class="flex justify-between items-center mb-4">
        @hasanyrole('superadmin|administrator')
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.announcement-modal' })" class="mb-4">
            New Announcement
        </x-primary-button>

        <div class="flex items-center">
            <input type="text" wire:model="search" class="border p-2 rounded mr-2 h-8">
            <x-primary-button wire:click="searchAnnouncement" class="ml-2">
                Search
            </x-primary-button>
        </div>
    </div>
        @endhasanyrole
        @forelse($announcements as $announcement)
        <tr class="hover:bg-gray-100 cursor-pointer"
        wire:click="$dispatch('openModal', { component: 'modals.show.announcement-modal', arguments: { announcement: {{ $announcement }} }})">
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    {{ $announcement->title }}
                </td>
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    <x-secondary-button wire:click.stop="$dispatch('openModal', { component: 'modals.show.announcement-modal', arguments: { announcement: {{ $announcement }} }})">
                        View
                    </x-secondary-button>
                    @hasanyrole('superadmin|administrator')
                    <x-secondary-button wire:click.stop="$dispatch('openModal', { component: 'modals.announcement-modal', arguments: { announcement: {{ $announcement }} }})">
                        Edit
                    </x-secondary-button>
                    <x-secondary-button wire:click.stop="pinned_announcement({{ $announcement->id }})">
                    {{ $announcement->is_pinned ? 'Unpin' : 'Pin' }}
                    </x-secondary-button>
                    @endhasanyrole
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="px-6 py-4 text-sm leading-5 text-gray-900">
                    No announcement available.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div class="mt-5">
        {{-- Pagination links --}}
        {{ $announcements->links() }}
    </div>
</div>

