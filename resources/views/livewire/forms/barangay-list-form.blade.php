<div class="p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>

    <form wire:submit="save">
        <div>
            <x-input-label for="barangay" :value="__('Barangay')" />
            <x-text-input wire:model="form.barangay" id="barangay" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.barangay')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="district" :value="__('District')" />
            <select wire:model="form.district" id="district" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option selected>Select your District</option>
                <option value="North">North</option>
                <option value="South">South</option>
            </select> 
            <x-input-error :messages="$errors->get('form.district')" class="mt-2" />
        </div>

        <!-- Save button -->
        <div class="mt-4">
            <x-primary-button>
                Save
            </x-primary-button>
        </div>
    </form>
</div>
