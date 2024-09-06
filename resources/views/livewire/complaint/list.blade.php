<div class="min-w-full align-middle">
    <table class="min-w-full border divide-y divide-gray-200">
        <!-- Table Header -->
        <thead>
        <tr>
            <th class="px-6 py-3 text-left bg-gray-50">
                <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Name</span>
            </th>
            <th class="px-6 py-3 text-left bg-gray-50">
                <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Title</span>
            </th>
            <th class="px-6 py-3 text-left bg-gray-50">
            <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Status</span>
            </th>
            <th class="px-6 py-3 text-left bg-gray-50"></th>
        </tr>
        </thead>
        <!-- Table Body -->
        <tbody class="bg-white divide-y divide-gray-200 divide-solid">
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.complaint-modal' })" class="mb-4">
            New Complaint
        </x-primary-button>
        @forelse($complaints as $complaint)
            <tr>
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    {{ $complaint->name }}
                </td>
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    {{ $complaint->title }}
                </td>
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                {{ $complaint->status }}
                </td>
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    <x-secondary-button wire:click="$dispatch('openModal', { component: 'modals.show.complaint-modal', arguments: { complaint: {{ $complaint}} }})">
                        View
                    </x-secondary-button>
                    @if($complaint->status <> 'done')
                        @hasanyrole('superadmin|administrator')
                            <x-secondary-button wire:click="$dispatch('openModal', { component: 'modals.complaint-modal', arguments: { complaint: {{ $complaint }} }})">
                                Edit
                            </x-secondary-button>
                        @endhasanyrole
                    <x-secondary-button wire:click="markAsDone({{ $complaint->id }})">
                        Done
                    </x-secondary-button>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="px-6 py-4 text-sm leading-5 text-gray-900">
                    No complaint available.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
    <div class="mt-5">
        {{-- Pagination links --}}
        {{ $complaints->links() }}
    </div>
</div>

