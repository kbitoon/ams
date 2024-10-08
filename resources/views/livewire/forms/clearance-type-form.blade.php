<div class="p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
            &times;
    </button>
    <form wire:submit="save">
        <!-- Name input -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="form.name" id="name" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
        </div>
        <!-- Description input -->
        <div class="mt-4">
            <x-input-label for="amount" :value="__('Amount')" />
            <textarea wire:model="form.amount" id="amount" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
            <x-input-error :messages="$errors->get('form.amount')" class="mt-2" />
        </div>
        <div class="mt-4" wire:ignore>
            <x-input-label for="requirement" :value="__('Requirement')" />
{{--            <textarea wire:model="form.requirement" id="requirement" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>--}}
            <trix-editor
                id="requirement"
                class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                x-data
                x-on:trix-change="$dispatch('input', event.target.value)"
                x-ref="trix"
                wire:model.debounce.60s="form.requirement"
                wire:key="requirementKey"
            ></trix-editor>
            <x-input-error :messages="$errors->get('form.requirement')" class="mt-2" />
        </div>
        <!-- Save button -->
        <div class="mt-4">
            <x-primary-button>
                Save
            </x-primary-button>
        </div>
    </form>
</div>
