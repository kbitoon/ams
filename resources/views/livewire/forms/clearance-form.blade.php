<div class="p-6">
    <form wire:submit="save">
        <!-- Name input -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="form.name" id="name" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
        </div>
        <!-- Description input -->
        <div class="mt-4">
            <x-input-label for="purpose" :value="__('Purpose')" />
            <textarea wire:model="form.purpose" id="purpose" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
            <x-input-error :messages="$errors->get('form.purpose')" class="mt-2" />
        </div>
        <!-- Save button -->
        <div class="mt-4">
            <x-primary-button>
                Save
            </x-primary-button>
        </div>
    </form>
</div>
