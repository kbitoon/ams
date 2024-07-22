<style type="text/css">
    body {
    margin: 0;
    font-family: Arial, sans-serif;
}

.flex-container {
    display: flex;
    flex-direction: row;
    gap: 20px;
    flex-wrap: wrap;
}

.form-instructions, .form-container {
    flex: 1;
    padding: 20px;
    margin: 0 auto;
    max-width: 800px;
    line-height: 1.2;
    font-size: 13px;
}

.form-instructions center {
    display: block;
    text-align: center;
    margin-bottom: 20px;
}

.form-instructions ol,
.form-instructions ul {
    padding-left: 20px;
}

.form-instructions li {
    margin-bottom: 10px;
}

@media (max-width: 600px) {
    .flex-container {
        flex-direction: column;
    }

    .form-instructions {
        order: -1;
        padding: 10px;
    }

    .form-instructions ol,
    .form-instructions ul {
        padding-left: 15px;
    }

    .form-instructions li {
        font-size: 14px;
    }

    .form-container {
        padding: 10px;
    }
}

@media (min-width: 640px) {
    .sm\:max-w-md {
        max-width: 40rem !important;
    }

</style>
<div class="flex-container">
    <div class="form-container">
        <form wire:submit.prevent="save">
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
                    @forelse($clearanceTypes as $clearanceType)
                        <option value="{{ $clearanceType->id }}">{{ $clearanceType->name }}</option>
                    @empty
                        <option>No types available</option>
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
                <x-input-label for="contact_number" :value="__('Contact Number')" />
                <x-text-input wire:model="form.contact_number" id="contact_number" class="mt-1 block w-full" type="text" />
                <x-input-error :messages="$errors->get('form.contact_number')" class="mt-2" />
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
        <center><strong>Form Submission Instructions</strong></center>
        <p>To complete and submit the form, follow these steps:</p>
        <ol>
            <li><strong>Enter Your Name:</strong> Find the "Name" field. Type your full name in the text box provided.</li>
            <li><strong>Select the Type:</strong> Locate the "Type" dropdown. Click the dropdown and choose the appropriate type from the list.</li>
            <li><strong>Enter the Amount:</strong> Find the "Amount" field. Enter the required amount in the text box.</li>
            <li><strong>Select the Date:</strong> Locate the "Date" field. Use the date picker to select the relevant date.</li>
            <li><strong>Specify the Purpose:</strong> Find the "Purpose" field. Enter the purpose of your submission in the text box provided and select the appropriate option from the autocomplete suggestions.</li>
            <li><strong>Add Any Notes:</strong> Locate the "Notes" section. Enter any additional information or notes in the text area.</li>
            <li><strong>Provide Your Contact Number:</strong> Find the "Contact Number" field. Enter your phone number in the text box provided.</li>
            <li><strong>Attach Files (if any):</strong> Locate the "Attachment" field. Click the "Choose Files" button to upload any necessary files.</li>
            <li><strong>Submit the Form:</strong> Review all the entered information for accuracy. Click the "Save" button to submit the form.</li>
        </ol>
        <p><strong>Tips:</strong></p>
        <ul>
            <li>Make sure all required fields are filled out correctly.</li>
            <li>If there are any errors, they will be displayed below the respective fields.</li>
            <li>Ensure your attachments are in the correct format and within size limits.</li>
        </ul>
        <p>Thank you for filling out the form!</p>
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
                    return {
                        label: item.purpose,
                        value: item.purpose
                    };
                });

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

</script>
