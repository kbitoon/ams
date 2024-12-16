<div class="min-w-full align-middle">
    <table class="min-w-full border divide-y divide-gray-200">
        <!-- Table Header -->
        <thead>
            <tr>
                <th class="px-6 py-3 text-left bg-gray-50">
                    <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Name</span>
                </th>
                <th class="px-6 py-3 text-left bg-gray-50">
                    <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Type</span>
                </th>
                <th class="px-6 py-3 text-left bg-gray-50"></th>
            </tr>
        </thead>
        <!-- Table Body -->
        <div class="flex justify-between items-center mb-4">
            <!-- New Clearance button -->
            <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.clearance-modal' })" class="h-8">
                <span class="hidden sm:inline">New Clearance</span>
                <span class="sm:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </span>
            </x-primary-button>
            
            <!-- Search Input and Button -->
            <div class="flex items-center">
                <input type="text" wire:model="search" class="border p-2 rounded mr-2 h-8" placeholder="Search...">
                <x-primary-button wire:click="searchClearance" class="h-8">
                    <span class="hidden sm:inline">Search</span>
                    <span class="sm:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                            <path fill-rule="evenodd" d="M12.9 14.32a8 8 0 111.41-1.41l3.9 3.9a1 1 0 11-1.42 1.42l-3.9-3.9zM8 14A6 6 0 108 2a6 6 0 000 12z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </x-primary-button>
            </div>
        </div>

        @forelse($clearances as $clearance)
        <tr class="hover:bg-gray-100 cursor-pointer"
            wire:click="$dispatch('openModal', { component: 'modals.show.clearance-modal', arguments: { clearance: {{ $clearance }} }})">
            <td class="px-6 py-4 text-sm leading-5 text-gray-900 flex items-center space-x-2">
                {{ \Illuminate\Support\Str::title($clearance->name) }}
            </td>
            <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                {{ $clearance->type->name }}
            </td>
            <td class="px-6 py-4 text-sm leading-5 text-gray-900">
            @hasanyrole('superadmin|administrator|support')
            <div class="flex items-center space-x-2 flex-wrap">
                <div class="flex items-center">
                                <x-secondary-button wire:click.stop="$dispatch('openModal', { component: 'modals.clearance-modal', arguments: { clearance: {{ $clearance }} }})" class="flex items-center mr-2">
                                    <i class="fas fa-pencil-alt"></i>
                                </x-secondary-button>
                @if($clearance->status <> 'Done') 
                                <x-secondary-button wire:click.stop="markAsDone({{ $clearance->id }})" class="flex items-center">
                                    <i class="fas fa-check mr-1"></i>
                                </x-secondary-button>
                            </div>
                            @if(optional($clearance->user)->hasRole('user') || optional($clearance->user)->hasRole('anonymous'))
                                <i class="fas fa-flag ml-2 text-red-500"></i>
                            @endif
                        </div>
                    @endhasanyrole
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="px-6 py-4 text-sm leading-5 text-gray-900">
                No clearance available.
            </td>
        </tr>
        @endforelse

        </tbody>
    </table>
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
