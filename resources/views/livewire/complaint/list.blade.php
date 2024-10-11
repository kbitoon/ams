<div class="min-w-full align-middle">
    <div class="overflow-x-auto"> <!-- Added wrapper for horizontal scrolling -->
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
            <div class="flex justify-between items-center mb-4">
                <div class="flex items-center">
                    @hasanyrole('superadmin|administrator|support')
                    <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.complaint-modal' })" class="h-8 mr-2">
                        <span class="hidden sm:inline">New Complaint</span>
                        <span class="sm:hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                        </span>
                    </x-primary-button>
                    @endhasanyrole
                </div>
                <div class="flex items-center">
                    <input type="text" wire:model="search" class="border p-2 rounded h-8 w-full sm:w-auto" placeholder="Search...">
                    <x-primary-button wire:click="searchComplaint" class="ml-1 h-8"> 
                        <span class="hidden sm:inline">Search</span>
                        <span class="sm:hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                                <path fill-rule="evenodd" d="M12.9 14.32a8 8 0 111.41-1.41l3.9 3.9a1 1 0 11-1.42 1.42l-3.9-3.9zM8 14A6 6 0 108 2a6 6 0 000 12z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </x-primary-button>
                </div>
            </div>

            @forelse($complaints as $complaint)
            <tr class="hover:bg-gray-100 cursor-pointer"
                wire:click="$dispatch('openModal', { component: 'modals.show.complaint-modal', arguments: { complaint: {{ $complaint }} }})">
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
                    <div class="flex items-center space-x-2"> <!-- Keeping the buttons inline -->
                        @if($complaint->status !== 'Done')
                        @hasanyrole('superadmin|administrator|support')
                        <x-secondary-button wire:click.stop="$dispatch('openModal', { component: 'modals.complaint-modal', arguments: { complaint: {{ $complaint }} }})" class="flex items-center">
                            <i class="fas fa-pencil-alt"></i>
                        </x-secondary-button>
                        @endhasanyrole

                        <x-secondary-button wire:click.stop="markAsDone({{ $complaint->id }})" class="flex items-center">
                            <i class="fas fa-check mr-1"></i>
                        </x-secondary-button>
                       
                    </div>
                    <span class="text-xs text-gray-500 mt-1"> <!-- Time ago directly below the buttons -->
                        {{ $this->getTimeAgo($complaint->created_at) }}
                    </span>
                    @endif
                </td>
                
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-4 text-sm leading-5 text-gray-900">
                    No complaint available.
                </td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div> <!-- End of wrapper for scrolling -->
    <div class="mt-5">
        {{-- Pagination links --}}
        {{ $complaints->links() }}
    </div>
</div>
