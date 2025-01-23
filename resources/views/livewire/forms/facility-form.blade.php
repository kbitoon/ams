<div class="p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>

    <form wire:submit="save">
        
        <div>
            <x-input-label for="name" :value="__('Facility Name')" />
            <x-text-input wire:model="form.name" id="name" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="location" :value="__('Location')" />
            <x-text-input wire:model="form.location" id="location" class="mt-1 block w-full"/>
            <x-input-error :messages="$errors->get('form.location')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="status" :value="__('Status')" />
            <select wire:model="form.status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="" selected>Please select a status</option>
                <option value="Available">Available</option>
                <option value="Unavailable">Unavailable</option>
            </select>
            <x-input-error :messages="$errors->get('form.status')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="calendar_color" :value="__('Color')" />
            <input wire:model="form.calendar_color" id="calendar_color" class="mt-1 block w-full h-10 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="color" />
            <x-input-error :messages="$errors->get('form.calendar_color')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-primary-button> 
                Save
            </x-primary-button>
        </div>
    </form>
</div>
