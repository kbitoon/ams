<div class="p-6 max-h-[90vh] overflow-y-auto">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    
    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
        {{ $resource ? 'Edit Resource' : 'New Resource' }}
    </h2>

    <form wire:submit="save">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="resource_type" :value="__('Resource Type')" />
                <select wire:model="form.resource_type" id="resource_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    <option value="equipment">Equipment</option>
                    <option value="vehicle">Vehicle</option>
                    <option value="facility">Facility</option>
                    <option value="personnel">Personnel</option>
                    <option value="supplies">Supplies</option>
                </select>
                <x-input-error :messages="$errors->get('form.resource_type')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="disaster_event_id" :value="__('Disaster Event (Optional)')" />
                <select wire:model="form.disaster_event_id" id="disaster_event_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="">None (General Resource)</option>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}">{{ $event->title }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('form.disaster_event_id')" class="mt-2" />
            </div>
        </div>

        <div class="mt-4">
            <x-input-label for="name" :value="__('Resource Name')" />
            <x-text-input wire:model="form.name" id="name" class="mt-1 block w-full" type="text" required />
            <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="description" :value="__('Description (Optional)')" />
            <textarea wire:model="form.description" id="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" rows="3"></textarea>
            <x-input-error :messages="$errors->get('form.description')" class="mt-2" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
            <div>
                <x-input-label for="quantity" :value="__('Quantity')" />
                <x-text-input wire:model="form.quantity" id="quantity" class="mt-1 block w-full" type="number" step="0.01" min="0.01" required />
                <x-input-error :messages="$errors->get('form.quantity')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="unit" :value="__('Unit (Optional)')" />
                <x-text-input wire:model="form.unit" id="unit" class="mt-1 block w-full" type="text" placeholder="e.g., pieces, kg, liters" />
                <x-input-error :messages="$errors->get('form.unit')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="status" :value="__('Status')" />
                <select wire:model="form.status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="available">Available</option>
                    <option value="in_use">In Use</option>
                    <option value="damaged">Damaged</option>
                    <option value="unavailable">Unavailable</option>
                </select>
                <x-input-error :messages="$errors->get('form.status')" class="mt-2" />
            </div>
        </div>

        <div class="mt-4">
            <x-input-label for="location" :value="__('Location (Optional)')" />
            <x-text-input wire:model="form.location" id="location" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.location')" class="mt-2" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div>
                <x-input-label for="assigned_team_id" :value="__('Assigned Team (Optional)')" />
                <select wire:model="form.assigned_team_id" id="assigned_team_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="">None</option>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('form.assigned_team_id')" class="mt-2" />
            </div>
        </div>

        <div class="mt-4">
            <x-input-label for="notes" :value="__('Notes (Optional)')" />
            <textarea wire:model="form.notes" id="notes" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" rows="3"></textarea>
            <x-input-error :messages="$errors->get('form.notes')" class="mt-2" />
        </div>

        <div class="mt-6 flex justify-end gap-3">
            <x-secondary-button wire:click="closeModal" type="button">Cancel</x-secondary-button>
            <x-primary-button type="submit">Save</x-primary-button>
        </div>
    </form>
</div>
