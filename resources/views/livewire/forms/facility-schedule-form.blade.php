<div class="p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>

    <form wire:submit="save">

        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="form.name" id="name" class="mt-1 block w-full"/>
            <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="facility_id" :value="__('Facility')" />
            <select wire:model="form.facility_id" id="facility_id" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option selected>Please select a facility</option>
                @forelse($facilities as $facility)
                    <option value="{{ $facility->id }}">{{ $facility->name }}</option>
                @empty
                    <option>No Facility available</option>
                @endforelse
            </select>
            <x-input-error :messages="$errors->get('form.facility_id')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="start" :value="__('Start')" />
            <x-input-datetime wire:model="form.start" id="start" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.start')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="end" :value="__('End')" />
            <x-input-datetime wire:model="form.end" id="end" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.end')" class="mt-2" />
        </div>

        
        <div class="mt-4">
            <x-input-label for="purpose" :value="__('Purpose')" />
            <textarea wire:model="form.purpose" id="purpose" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
            <x-input-error :messages="$errors->get('form.purpose')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-primary-button> 
                Save
            </x-primary-button>
        </div>
    </form>
</div>
  