<div class="p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    <form wire:submit="save">
        <!-- Name input -->
        <div>
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input wire:model="form.first_name" id="first_name" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.first_name')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="last_name" :value="__('Last Name')" />
            <x-text-input wire:model="form.last_name" id="last_name" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.last_name')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="age" :value="__('Age')" />
            <x-text-input wire:model="form.age" id="age" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.age')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="group" :value="__('Group')" />
            <select wire:model="form.group" id="group" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option selected>Please select a group</option>
                <option value="Out of School Youth">Out of School Youth</option>
                <option value="Malnourished Children">Malnourished Children</option>
                <option value="Senior Citizen">Senior Citizen</option>
                <option value="Pregnant">Pregnant</option>
                <option value="Single Parent">Single Parent</option>
            </select>
            <x-input-error :messages="$errors->get('form.group_id')" class="mt-2" />
        </div>

        <!-- Save button -->
        <div class="mt-4">
            <x-primary-button>
                Save
            </x-primary-button>
        </div>
    </form>
</div>