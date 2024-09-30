<div class="p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none" wire:click="closeModal">
            &times;
    </button>
        <form wire:submit.prevent="save">

            <div class="mt-4">
                <x-input-label for="destination" :value="__('Destination')" />
                <x-text-input wire:model="form.destination" id="destination" class="mt-1 block w-full" type="text" />
                <x-input-error :messages="$errors->get('form.destination')" class="mt-2" />
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
                <x-input-label for="vehicle_id" :value="__('Vehicle')" />
                <select wire:model.live.debounce.250ms="form.vehicle_id" id="vehicle_id" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
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
                <x-input-label for="driver_id" :value="__('Driver')" />
                <select wire:model.live.debounce.250ms="form.driver_id" id="driver_id" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option selected>Please select a driver</option>
                    @forelse($drivers as $driver)
                        <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                    @empty
                        <option>No Driver available</option>
                    @endforelse
                </select>
                <x-input-error :messages="$errors->get('form.driver_id')" class="mt-2" />
            </div>
            

            <!-- Save button -->
            <div class="mt-4">
                <x-primary-button>
                    Save
                </x-primary-button>
            </div>
        </form>
</div>