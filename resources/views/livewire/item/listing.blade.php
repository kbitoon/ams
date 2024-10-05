<div class="p-6">
    <div class="flex justify-between items-center mb-4 mr-2">
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.item-modal' })" class="h-8 mr-2">
            <!-- Show text for large screens, icon for mobile -->
            <span class="hidden sm:inline">New Item</span>
            <span class="sm:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </span>
        </x-primary-button>
        
        <!-- Wrapping search and filter in a flex container -->
        <div class="flex items-center ml-auto"> <!-- ml-auto pushes it to the right -->
            <input type="text" wire:model="search" class="border p-1 rounded mr-2 h-8 w-full sm:w-32" placeholder="Search..."> <!-- Adjust width here -->
            <select wire:model="categoryFilter" class="border p-1 rounded h-8 w-full sm:w-32"> <!-- Adjust width here -->
                <option value="">All</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <x-primary-button wire:click="searchItems" class="ml-1 h-8">
                <!-- Show text for large screens, icon for mobile -->
                <span class="hidden sm:inline">Search</span>
                <span class="sm:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.9 14.32a8 8 0 111.41-1.41l3.9 3.9a1 1 0 11-1.42 1.42l-3.9-3.9zM8 14A6 6 0 108 2a6 6 0 000 12z" clip-rule="evenodd" />
                    </svg>
                </span>
            </x-primary-button>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Name</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Date Acquired</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Remaining Quantity</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($items as $item)
                    <tr>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            {{ $item->name }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            {{ $item->acquired }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            {{ $item->QuantityLeft }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            @hasanyrole('superadmin|administrator')
                                <x-secondary-button wire:click="$dispatch('openModal', { component: 'modals.item-modal', arguments: { item: {{ $item->id }} }})">
                                <i class="fas fa-pencil-alt"></i>
                                </x-secondary-button>
                            @endhasanyrole
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-sm leading-5 text-gray-900">
                            No items found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        {{-- Pagination links --}}
        {{ $items->links() }}
    </div>
</div>
