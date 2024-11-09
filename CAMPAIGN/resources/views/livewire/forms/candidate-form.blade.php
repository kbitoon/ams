<div class="p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>

    <form wire:submit="save">
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="form.name" id="name" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="position" :value="__('Position')" />
            <select wire:model="form.position" id="position" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option selected>Select your Position</option>
                <option value="Mayor">Mayor</option>
                <option value="Vice Mayor">Vice Mayor</option>
                <option value="Congress">Congress</option>
                <option value="Councilor">Councilor</option>
                
            </select> 
            <x-input-error :messages="$errors->get('form.position')" class="mt-2" />
        </div>

        <!-- Save button -->
        <div class="mt-4">
            <x-primary-button>
                Save
            </x-primary-button>
        </div>
    </form>
</div>
