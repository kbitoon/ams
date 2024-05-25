<div class="p-6">
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
            <textarea wire:model="form.purpose" id="purpose" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
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
