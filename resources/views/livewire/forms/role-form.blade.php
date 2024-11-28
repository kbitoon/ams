<div class="p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    <form wire:submit.prevent="save">
        <!-- Role Name input -->
        <div>
            <x-input-label for="name" :value="__('Role Name')" />
            <x-text-input wire:model="form.name" id="name" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
        </div>

        <!-- Role Color input with color picker -->
        <div class="mt-4">
            <x-input-label for="color" :value="__('Role Color (Optional)')" />
            <input wire:model="form.color" id="color" class="mt-1 block w-full" type="color" value="{{ $form->color ?? '#e2e8f0' }}" />
            <x-input-error :messages="$errors->get('form.color')" class="mt-2" />
        </div>

        <!-- Save button -->
        <div class="mt-4 flex justify-end">
            <x-primary-button>Save</x-primary-button>
        </div>
    </form>
</div>
