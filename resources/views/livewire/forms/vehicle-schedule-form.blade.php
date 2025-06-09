<div class="p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    <form wire:submit.prevent="save">
        @if ($errors->has('vehicle_id'))
            <div class="mt-2 text-red-600">{{ $errors->first('vehicle_id') }}</div>
        @endif

        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="form.name" id="name" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="destination" :value="__('Destination')" />
            <x-text-input wire:model="form.destination" id="destination" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.destination')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="start" :value="__('Start')" />
            <input type="datetime-local" wire:model="form.start" id="start" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="text" />
            <x-input-error :messages="$errors->get('form.start')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="end" :value="__('End')" />
            <input type="datetime-local" wire:model="form.end" id="end" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="text" />
            <x-input-error :messages="$errors->get('form.end')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="vehicle_id" :value="__('Vehicle')" />
            <select wire:model="form.vehicle_id" id="vehicle_id" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option selected>Please select a vehicle</option>
                @forelse($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                @empty
                    <option>No Vehicle available</option>
                @endforelse
            </select>
            <x-input-error :messages="$errors->get('form.vehicle_id')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="details" :value="__('Details')" />
            <textarea wire:model="form.details" id="details" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="text"> </textarea>
            <x-input-error :messages="$errors->get('form.details')" class="mt-2" />
        </div>

        @hasanyrole('superadmin|administrator|support')
        <div class="mt-4">
            <x-input-label for="driver_id" :value="__('Driver')" />
            <select wire:model="form.driver_id" id="driver_id" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="" selected>Please select a driver</option>
                @forelse($drivers as $driver)
                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                @empty
                    <option>No Driver available</option>
                @endforelse
            </select>
            <x-input-error :messages="$errors->get('form.driver_id')" class="mt-2" />
        </div>
        @endhasanyrole
        <!-- Save button -->
        <div class="mt-4">
            <x-primary-button>
                Save
            </x-primary-button>
        </div>
    </form>
</div>
