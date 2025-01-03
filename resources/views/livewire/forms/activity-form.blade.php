<div class="p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>

    <form wire:submit="save">
        
        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input wire:model="form.title" id="title" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.title')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="start" :value="__('Start')" />
            <input type="datetime-local" wire:model="form.start" id="start" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="text" />
            <x-input-error :messages="$errors->get('form.start')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="end" :value="__('End')" />
            <<input type="datetime-local" wire:model="form.end" id="end" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="text" />
            <x-input-error :messages="$errors->get('form.end')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="location" :value="__('Location')" />
            <x-text-input wire:model="form.location" id="location" class="mt-1 block w-full"/>
            <x-input-error :messages="$errors->get('form.location')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="description" :value="__('Description')" />
            <textarea wire:model="form.description" id="description" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
            <x-input-error :messages="$errors->get('form.description')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-primary-button> 
                Save
            </x-primary-button>
        </div>
    </form>
</div>
