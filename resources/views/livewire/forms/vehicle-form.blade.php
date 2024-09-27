<div class="p-6 z-30 relative">
    <form wire:submit.prevent="save">
        <!-- Name input -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="form.name" id="name" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
        </div>

        <!-- Description input -->
        <div class="mt-4">
            <x-input-label for="description" :value="__('Description')" />
            <x-text-input wire:model="form.description" id="description" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.description')" class="mt-2" />
        </div>

        <!-- Status input -->
        <div class="mt-4">
            <x-input-label for="status" :value="__('Status')" />
            <select wire:model="form.status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="" selected>Please select a status</option>
                <option value="Available">Available</option>
                <option value="Unavailable">Unavailable</option>
            </select>
            <x-input-error :messages="$errors->get('form.status')" class="mt-2" />
        </div>

        <!-- Save button -->
        <div class="mt-4">
            <x-primary-button>
                Save
            </x-primary-button>
        </div>
    </form>
</div>
