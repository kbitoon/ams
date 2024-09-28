<div class="min-w-full align-middle overflow-x-auto">
    <table class="min-w-full border divide-y divide-gray-200">
        <!-- Table Header -->
        <thead>
        <tr>
            <th class="px-2 py-3 text-left bg-gray-50">
                <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Name</span>
            </th>
            <th class="px-2 py-3 text-left bg-gray-50">
                <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Title</span>
            </th>
            <th class="px-2 py-3 text-left bg-gray-50">
                <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Status</span>
            </th>
            <th class="px-2 py-3 text-left bg-gray-50"></th>
        </tr>
        </thead>
        <!-- Table Body -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-4">
            <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.complaint-modal' })" class="mb-4 sm:mb-0">
                New Complaint
            </x-primary-button>
            <div class="flex items-center">
                <input type="text" wire:model="search" placeholder="Search..." class="border p-2 rounded mr-2 h-8 w-full sm:w-auto">
                <x-primary-button wire:click="searchComplaint" class="ml-2">
                    Search
                </x-primary-button>
            </div>
        </div>
        @forelse($complaints as $complaint)
            <tr>
                <td class="px-2 py-4 text-sm leading-5 text-gray-900 whitespace-normal break-words">
                    {{ $complaint->name }}
                </td>
                <td class="px-2 py-4 text-sm leading-5 text-gray-900 whitespace-normal break-words">
                    {{ $complaint->title }}
                </td>
                <td class="px-2 py-4 text-sm leading-5 text-gray-900">
                    {{ $complaint->status }}
                </td>
                <td class="px-2 py-4 text-sm leading-5 text-gray-900 flex flex-wrap gap-2">
                    <x-secondary-button wire:click="$dispatch('openModal', { component: 'modals.show.complaint-modal', arguments: { complaint: {{ $complaint }} }})">
                        View
                    </x-secondary-button>
                    @if($complaint->status <> 'done')
                        @hasanyrole('superadmin|administrator|support')
                            <x-secondary-button wire:click="$dispatch('openModal', { component: 'modals.complaint-modal', arguments: { complaint: {{ $complaint }} }})">
                                Edit
                            </x-secondary-button>
                        @endhasanyrole
                        <x-secondary-button wire:click="markAsDone({{ $complaint->id }})">
                            Done
                        </x-secondary-button>
                        <span class="text-xs text-gray-500 ml-2">
                            {{ $this->getDaysAgo($complaint->created_at) }} day(s) ago
                        </span>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="px-2 py-4 text-sm leading-5 text-gray-900 text-center">
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
