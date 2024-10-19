<div class="p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>

    <form wire:submit="save">

        <div>
            <x-input-label for="date" :value="__('Date')" />
            <x-input-date wire:model="form.date" id="date" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.date')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="description" :value="__('Description')" />
            <textarea wire:model="form.description" id="description" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="text" ></textarea>
            <x-input-error :messages="$errors->get('form.description')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="location" :value="__('Location')" />
            <x-text-input wire:model="form.location" id="location" class="mt-1 block w-full"/>
            <x-input-error :messages="$errors->get('form.location')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="barangay" :value="__('Barangay')" />
            <x-text-input wire:model="form.barangay" id="barangay" class="mt-1 block w-full"/>
            <x-input-error :messages="$errors->get('form.barangay')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="district" :value="__('District')" />
            <x-text-input wire:model="form.district" id="district" class="mt-1 block w-full"/>
            <x-input-error :messages="$errors->get('form.district')" class="mt-2" />
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
