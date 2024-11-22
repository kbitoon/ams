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

        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="form.name" id="name" class="mt-1 block w-full"/>
            <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="narration" :value="__('Narration of Incident')" />
            <textarea wire:model="form.narration" id="narration" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
            <x-input-error :messages="$errors->get('form.narration')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="date" :value="__('Date')" />
            <x-input-date wire:model="form.date" id="date" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.date')" class="mt-2" />
        </div>


        <div class="mt-4">
            <x-primary-button> 
                Save
            </x-primary-button>
        </div>
    </form>
</div>
