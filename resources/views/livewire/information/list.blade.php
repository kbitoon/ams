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
            <div class="flex items-center">
                <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.information-modal' })" class="h-8">

                    <span class="hidden sm:inline">New Information</span>
                    <span class="sm:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </span>
                </x-primary-button>
            </div>
            @endhasanyrole

            <div class="flex items-center ml-auto">
                <input type="text" wire:model="search" class="border p-2 rounded h-8 w-full sm:w-auto" placeholder="Search...">
                <x-primary-button wire:click="searchInformation" class="ml-2 h-8">

                    <span class="hidden sm:inline">Search</span>
                    <span class="sm:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                            <path fill-rule="evenodd" d="M12.9 14.32a8 8 0 111.41-1.41l3.9 3.9a1 1 0 11-1.42 1.42l-3.9-3.9zM8 14A6 6 0 108 2a6 6 0 000 12z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </x-primary-button>
            </div>
        </div>
        
        @forelse($informations as $information)
        <tr class="hover:bg-gray-100 cursor-pointer"
        wire:click="$dispatch('openModal', { component: 'modals.show.information-modal', arguments: { information: {{ $information }} }})">
            <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                {{ $information->title }}
            </td>
            <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                @hasanyrole('superadmin|administrator')
                <x-secondary-button wire:click.stop="$dispatch('openModal', { component: 'modals.information-modal', arguments: { information: {{ $information }} }})">
                <i class="fas fa-pencil-alt"></i>
                </x-secondary-button>
                @endhasanyrole
            </td>
        </tr>
        @empty
            <tr>
                <td colspan="2" class="px-6 py-4 text-sm leading-5 text-gray-900">
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
