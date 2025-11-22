<div class="p-6">
    <!-- Header with New Clearance button -->
    <div class="flex justify-between items-center mb-4">
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.clearance-modal' })" class="h-8">
            <span class="hidden sm:inline">New Clearance</span>
            <span class="inline sm:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </span>
        </x-primary-button>
    </div>

    <!-- Filters -->
    <div class="mb-4 flex flex-col sm:flex-row flex-wrap gap-4">
        <!-- Search Input -->
        <div class="flex-1 w-full sm:min-w-[200px]">
            <x-input-label for="search" value="Search by Name" />
            <input 
                type="text" 
                id="search"
                wire:model.live.debounce.300ms="search" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                placeholder="Search by name..."
            >
        </div>

        <!-- Status Filter -->
        <div class="flex-1 w-full sm:min-w-[200px]">
            <x-input-label for="filterStatus" value="Filter by Status" />
            <select 
                id="filterStatus"
                wire:model.live="filterStatus" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
            >
                <option value="">All</option>
                <option value="Pending">Pending</option>
                <option value="Done">Done</option>
            </select>
        </div>

        <!-- Clearance Type Filter -->
        <div class="flex-1 w-full sm:min-w-[200px]">
            <x-input-label for="filterTypeId" value="Filter by Type" />
            <select 
                id="filterTypeId"
                wire:model.live="filterTypeId" 
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
            >
                <option value="">All Types</option>
                @foreach($clearanceTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>

        @if($search || $filterStatus !== '' || $filterTypeId !== '')
        <div class="w-full sm:w-auto">
            <div class="hidden sm:block h-[21px]"></div>
            <x-secondary-button wire:click="resetFilters" class="h-10 mt-1 w-full sm:w-auto">
                Clear Filters
            </x-secondary-button>
        </div>
        @endif
    </div>

    <!-- Record Count Indicator -->
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        <span class="font-medium">{{ $totalCount }}</span> 
        {{ $totalCount === 1 ? 'record' : 'records' }} 
        {{ $search || $filterStatus !== '' || $filterTypeId !== '' ? 'found' : 'total' }}
    </div>

    <!-- Desktop Table View -->
    <div class="hidden md:block overflow-x-auto">
        <table class="min-w-full border divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Name</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Type</span>
                    </th>
                    <th class="px-6 py-3 text-left bg-gray-50">
                        <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Date</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($clearances as $clearance)
                    <tr class="hover:bg-gray-50 cursor-pointer"
                        wire:click="$dispatch('openModal', { component: 'modals.show.clearance-modal', arguments: { clearance: {{ $clearance }} }})">
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            {{ \Illuminate\Support\Str::title($clearance->name) }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            {{ $clearance->type->name }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            @if($clearance->status <> 'Done')
                                <span class="text-xs text-gray-500">
                                    {{ $this->getTimeAgo($clearance->created_at) }}
                                </span>
                            @else
                                <span class="text-xs text-gray-500">
                                    {{ $clearance->created_at->format('F j, Y') }}
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                            <div class="flex items-center justify-end gap-2">
                                @hasanyrole('superadmin|administrator|support')
                                    <div class="relative" x-data="{ showActions: false }">
                                        <button 
                                            @click.stop="showActions = !showActions"
                                            class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 focus:outline-none p-1"
                                            type="button"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                                            </svg>
                                        </button>
                                        
                                        <div x-show="showActions"
                                             x-transition:enter="transition ease-out duration-100"
                                             x-transition:enter-start="opacity-0 transform scale-95"
                                             x-transition:enter-end="opacity-100 transform scale-100"
                                             x-transition:leave="transition ease-in duration-75"
                                             x-transition:leave-start="opacity-100 transform scale-100"
                                             x-transition:leave-end="opacity-0 transform scale-95"
                                             @click.away="showActions = false"
                                             class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg border border-gray-200 dark:border-gray-700 z-10">
                                            <div class="py-1">
                                                @if($clearance->status <> 'Done')
                                                    <button 
                                                        wire:click.stop="$dispatch('openModal', { component: 'modals.clearance-modal', arguments: { clearance: {{ $clearance }} }})"
                                                        class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center gap-2"
                                                    >
                                                        <i class="fas fa-pencil-alt text-gray-500"></i>
                                                        <span>Edit</span>
                                                    </button>

                                                    <button 
                                                        wire:click.stop="markAsDone({{ $clearance->id }})"
                                                        class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 flex items-center gap-2"
                                                    >
                                                        <i class="fas fa-check text-green-500"></i>
                                                        <span>Mark as Done</span>
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endhasanyrole
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-sm leading-5 text-gray-900 text-center">
                            No clearance available.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Mobile Card View -->
    <div class="md:hidden space-y-4">
        @forelse($clearances as $clearance)
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm p-4 relative" x-data="{ showActions: false }">
                <!-- Three-dot menu button (top right) -->
                @hasanyrole('superadmin|administrator|support')
                    @if($clearance->status <> 'Done')
                        <button 
                            @click="showActions = !showActions"
                            class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 focus:outline-none p-1"
                            type="button"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                            </svg>
                        </button>
                    @endif
                @endhasanyrole

                <div class="space-y-3 pr-8" wire:click="$dispatch('openModal', { component: 'modals.show.clearance-modal', arguments: { clearance: {{ $clearance }} }})">
                    <!-- Name -->
                    <div>
                        <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Name</div>
                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                            {{ \Illuminate\Support\Str::title($clearance->name) }}
                        </div>
                    </div>

                    <!-- Type and Date (Side by Side) -->
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Type -->
                        <div>
                            <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Type</div>
                            <div class="text-sm text-gray-900 dark:text-gray-100">
                                {{ $clearance->type->name }}
                            </div>
                        </div>

                        <!-- Date -->
                        <div>
                            <div class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Date</div>
                            <div class="text-sm text-gray-900 dark:text-gray-100">
                                @if($clearance->status <> 'Done')
                                    <span class="text-xs text-gray-500">
                                        {{ $this->getTimeAgo($clearance->created_at) }}
                                    </span>
                                @else
                                    <span class="text-xs text-gray-500">
                                        {{ $clearance->created_at->format('F j, Y') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons (Hidden by default, shown when menu is clicked) -->
                    @hasanyrole('superadmin|administrator|support')
                        @if($clearance->status <> 'Done')
                            <div x-show="showActions" 
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="opacity-0 transform scale-95"
                                 x-transition:enter-end="opacity-100 transform scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="opacity-100 transform scale-100"
                                 x-transition:leave-end="opacity-0 transform scale-95"
                                 @click.away="showActions = false"
                                 class="pt-2 border-t border-gray-200 dark:border-gray-700">
                                <div class="flex flex-col gap-2">
                                    <button 
                                        wire:click.stop="$dispatch('openModal', { component: 'modals.clearance-modal', arguments: { clearance: {{ $clearance }} }})"
                                        class="text-left px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md transition-colors flex items-center gap-2"
                                    >
                                        <i class="fas fa-pencil-alt text-gray-500"></i>
                                        <span>Edit</span>
                                    </button>

                                    <button 
                                        wire:click.stop="markAsDone({{ $clearance->id }})"
                                        class="text-left px-3 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-md transition-colors flex items-center gap-2"
                                    >
                                        <i class="fas fa-check text-green-500"></i>
                                        <span>Mark as Done</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                    @endhasanyrole
                </div>
            </div>
        @empty
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm p-6 text-center">
                <p class="text-sm text-gray-900 dark:text-gray-100">No clearance available.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-5">
        {{-- Pagination links --}}
        {{ $clearances->links() }}
    </div>
</div>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', (event) => {
        document.addEventListener('openModal', function (event) {
            if (event.detail && event.detail.component === 'modals.clearance-modal') {
                console.log("Modal shown, initializing autocomplete...");
                $(function() {
                    // Fetch dynamic tags from a server-side source
                    $.ajax({
                        url: '/clearancepurpose', // Replace with your endpoint
                        method: 'GET',
                        success: function(data) {
                            var purposes = [
                                { label: 'Business', value: 'Business' },
                                { label: 'Employment', value: 'Employment' },
                            ];

                            $("#purpose").autocomplete({
                                source: purposes,
                                select: function(event, ui) {
                                    $("#purpose").val(ui.item.value);
                                    let purposeInput = document.getElementById('purpose');
                                    purposeInput.dispatchEvent(new Event('input'));
                                    return false; // Prevent the default behavior of autocomplete
                                }
                            });
                        },
                        error: function(error) {
                            console.error("Error fetching tags:", error);
                        }
                    });
                });
            }
        });
    });
</script>
