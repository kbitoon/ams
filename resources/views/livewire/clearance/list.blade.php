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
        <tbody class="bg-white divide-y divide-gray-200 divide-solid">
        <x-primary-button wire:click="$dispatch('openModal', { component: 'modals.clearance-modal' })" class="mb-4">
            New Clearance
        </x-primary-button>
        @forelse($clearances as $clearance)
            <tr>
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    {{ $clearance->name }}
                </td>
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    {{ $clearance->type->name }}
                </td>
                <td class="px-6 py-4 text-sm leading-5 text-gray-900">
                    <x-secondary-button wire:click="">
                        View
                    </x-secondary-button>
                    @if($clearance->status <> 'done')
                        @hasanyrole('superadmin|administrator')
                            <x-secondary-button wire:click="$dispatch('openModal', { component: 'modals.clearance-modal', arguments: { clearance: {{ $clearance }} }})">
                                Edit
                            </x-secondary-button>
                        @endhasanyrole
                    <x-secondary-button wire:click="">
                        Done
                    </x-secondary-button>

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
                $(function() {
        // Fetch dynamic tags from a server-side source
        $.ajax({
            url: '/clearancepurpose', // Replace with your endpoint
            method: 'GET',
            // dataType: 'json',
            success: function(data) {
                // Assuming `data` is an array of objects with a 'purpose' property
                // var purposes = data.map(function(item) {
                //     return {
                //         label: item.label,
                //         value: item.value,
                //     };
                // });

                var purposes = [
                    { label: 'Business', value: 'Business' },
                    { label: 'Employment', value: 'Employment' },
                ];

                $("#purpose").autocomplete({
                    source: purposes,
                    select: function(event, ui) {
                        // Replace the existing value with the selected value
                        $("#purpose").val(ui.item.value);
                        // Manually trigger input event to update Livewire model
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