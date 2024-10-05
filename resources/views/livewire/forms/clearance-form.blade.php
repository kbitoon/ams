<div class="p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
            &times;
    </button>
    <div class="flex-container">
    <div class="form-container">
    <form wire:submit="save">
        <!-- Name input -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="form.name" id="name" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="type_id" :value="__('Type')" />
            <select wire:model.live.debounce.500ms="form.type_id" id="type_id" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option selected>Please select a type</option>
                @forelse($clearanceTypes as $clearanceTypes)
                    <option value="{{ $clearanceTypes->id }}">{{ $clearanceTypes->name }}</option>
                @empty
                @endforelse
            </select>
            <x-input-error :messages="$errors->get('form.type_id')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="amount" :value="__('Amount')" />
            <x-text-input wire:model="form.amount" id="amount" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.amount')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="date" :value="__('Date')" />
            <x-input-date wire:model="form.date" id="date" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.date')" class="mt-2" />
        </div>

        <!-- Purpose input -->
        <div class="mt-4">
            <x-input-label for="purpose" :value="__('Purpose')" />
            <x-text-input wire:model="form.purpose" id="purpose" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.purpose')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="notes" :value="__('Notes')" />
            <textarea wire:model="form.notes" id="notes" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
            <x-input-error :messages="$errors->get('form.notes')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="date" :value="__('Contact Number')" />
            <x-text-input wire:model="form.contact_number" id="contact_number" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.contact_number')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="date" :value="__('Complete Address')" />
            <textarea wire:model="form.address" id="address" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="text" ></textarea>
            <x-input-error :messages="$errors->get('form.address')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="attachments" :value="__('Attachment')" />
            <x-text-input wire:model="form.attachments" id="attachments" class="mt-1 block w-full rounded-none" type="file" multiple />
            <x-input-error :messages="$errors->get('form.attachments')" class="mt-2" />
        </div>

        <!-- Save button -->
        <div class="mt-4">
            <x-primary-button>
                Save
            </x-primary-button>
        </div>
    </form>
    </div>

    <div class="form-instructions">
        <!-- <center><strong>Form Submission Instructions</strong></center> -->
        <p>All clearances and certifications are free of charge. The following items are also <strong>delivered to your house for FREE</strong>, as part of our effort to improve and streamline the delivery of our services to the public: </p>
        <p></p>
        <ul>
            <li>Cohabitation</li>
            <li>Open Bank Account</li>
            <li>Postal/National ID</li>           
            <li>Police Clearance</li>
            <li>SSS Requirement</li>
            <li>Driver's License</li>
            <li>Board Exam</li>
            <li>Electrical/Water Connection</li>            
            <li>House Ownership</li>
        </ul>
        <p></p>
        <p>Other items can be picked up at the Barangay Hall with minimal to no waiting time.</p>
        <!--
        <ul>
            <li>Make sure all required fields are filled out correctly.</li>
            <li>If there are any errors, they will be displayed below the respective fields.</li>
            <li>Ensure your attachments are in the correct format and within size limits.</li>
        </ul> -->
        <p></p>
        <p>Thank you! #AbanteBacayan</p>
    </div>

</div>
</div>

<script>
$(function() {
    // Fetch dynamic tags from a server-side source
    $.ajax({
        url: '/clearancepurpose', // Replace with your endpoint
        method: 'GET',
        success: function(data) {
            // Assuming `data` is an array of objects with a 'purpose' property
            var purposes = data.map(function(item) {
                return item.purpose;
            });

            $("#purpose").autocomplete({
                source: purposes,
                select: function(event, ui) {
                    // Replace the existing value with the selected value
                    $("#purpose").val(ui.item.value);
                    return false; // Prevent the default behavior of autocomplete
                }
            });
        },
        error: function(error) {
            console.error("Error fetching tags:", error);
        }
    });
});
</script>
