<div class="p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none" wire:click="closeModal">
        &times;
    </button>
    <form wire:submit.prevent="save">
        <!-- Location Input -->
        <div class="mt-4">
            <x-input-label for="location" :value="__('Location')" />
            <x-text-input wire:model="form.location" id="location" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.location')" class="mt-2" />
        </div>

        <!-- Start DateTime Input -->
        <div>
            <x-input-label for="start" :value="__('Start')" />
            <x-input-datetime wire:model="form.start" id="start" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.start')" class="mt-2" />
        </div>

        <!-- End DateTime Input -->
        <div>
            <x-input-label for="end" :value="__('End')" />
            <x-input-datetime wire:model="form.end" id="end" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.end')" class="mt-2" />
        </div>

        <!-- Quantity Input -->
        <div class="mt-4">
            <x-input-label for="quantity" :value="__('Quantity')" />
            <x-text-input wire:model="form.quantity" id="quantity" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.quantity')" class="mt-2" />
        </div>

        <!-- Item Select -->
        <div class="mt-4">
            <x-input-label for="item_id" :value="__('Item')" />
            <select wire:model="form.item_id" id="item_id" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option selected>Please select an item</option>
                @forelse($items as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @empty
                    <option>No Item available</option>
                @endforelse
            </select>
            <x-input-error :messages="$errors->get('form.item_id')" class="mt-2" />
        </div>

        <!-- Purpose Input -->
        <div class="mt-4">
            <x-input-label for="purpose" :value="__('Purpose')" />
            <textarea wire:model="form.purpose" id="purpose" class="mt-1 block w-full" type="text"></textarea>
            <x-input-error :messages="$errors->get('form.purpose')" class="mt-2" />
        </div>

        <!-- Assigned To Input with Autocomplete -->
        <div class="mt-4">
            <x-input-label for="assigned" :value="__('Assigned To')" />
            <x-text-input wire:model="form.assigned" id="assigned" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.assigned')" class="mt-2" />
        </div>

        <!-- Save button -->
        <div class="mt-4">
            <x-primary-button>
                Save
            </x-primary-button>
        </div>
    </form>
</div>


<script>
    $(function() {
        // Fetch dynamic tags from a server-side source
        $.ajax({
            url: '/assigned-to', // Replace with your endpoint that returns a list of users or assignees
            method: 'GET',
            success: function(data) {
                // Assuming `data` is an array of objects with an 'assigned' property
                var assignedToList = data.map(function(item) {
                    return {
                        label: item.assigned,
                        value: item.assigned
                    };
                });

                $("#assigned").autocomplete({
                    source: assignedToList,
                    select: function(event, ui) {
                        // Replace the existing value with the selected value
                        $("#assigned").val(ui.item.value);
                        // Manually trigger input event to update Livewire model
                        let assignedInput = document.getElementById('assigned');
                        assignedInput.dispatchEvent(new Event('input'));
                        return false; // Prevent the default behavior of autocomplete
                    }
                });
            },
            error: function(error) {
                console.error("Error fetching assigned to list:", error);
            }
        });
    });
</script>
