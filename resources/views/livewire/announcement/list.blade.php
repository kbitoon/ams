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
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.announcement-modal' })" class="mb-4">
            New Announcement
        </x-primary-button>
        @endhasanyrole
        @forelse($announcements as $announcement)
            <tr>
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    {{ $announcement->title }}
                </td>
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    @hasanyrole('superadmin|administrator')
                    <x-secondary-button wire:click="$dispatch('openModal', { component: 'modals.announcement-modal', arguments: { announcement: {{ $announcement }} }})">
                        Edit
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
</div>

