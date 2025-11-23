<div class="p-6 max-h-[90vh] overflow-y-auto">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    
    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
        {{ $disasterEvent ? 'Edit Disaster Event' : 'New Disaster Event' }}
    </h2>

    <form wire:submit="save">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="disaster_type_id" :value="__('Disaster Type')" />
                <select wire:model="form.disaster_type_id" id="disaster_type_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    <option value="">Select Type</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('form.disaster_type_id')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="title" :value="__('Title')" />
                <x-text-input wire:model="form.title" id="title" class="mt-1 block w-full" type="text" required />
                <x-input-error :messages="$errors->get('form.title')" class="mt-2" />
            </div>
        </div>

        <div class="mt-4">
            <x-input-label for="description" :value="__('Description')" />
            <textarea wire:model="form.description" id="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" rows="3"></textarea>
            <x-input-error :messages="$errors->get('form.description')" class="mt-2" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div>
                <x-input-label for="status" :value="__('Status')" />
                <select wire:model="form.status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="draft">Draft</option>
                    <option value="active">Active</option>
                    <option value="resolved">Resolved</option>
                    <option value="cancelled">Cancelled</option>
                </select>
                <x-input-error :messages="$errors->get('form.status')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="severity" :value="__('Severity')" />
                <select wire:model="form.severity" id="severity" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                    <option value="critical">Critical</option>
                </select>
                <x-input-error :messages="$errors->get('form.severity')" class="mt-2" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div>
                <x-input-label for="start_date" :value="__('Start Date')" />
                <input type="date" wire:model="form.start_date" id="start_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                <x-input-error :messages="$errors->get('form.start_date')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="start_time" :value="__('Start Time')" />
                <input type="time" wire:model="form.start_time" id="start_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                <x-input-error :messages="$errors->get('form.start_time')" class="mt-2" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div>
                <x-input-label for="end_date" :value="__('End Date (Optional)')" />
                <input type="date" wire:model="form.end_date" id="end_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <x-input-error :messages="$errors->get('form.end_date')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="end_time" :value="__('End Time (Optional)')" />
                <input type="time" wire:model="form.end_time" id="end_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <x-input-error :messages="$errors->get('form.end_time')" class="mt-2" />
            </div>
        </div>

        <div class="mt-4">
            <x-input-label for="location" :value="__('Location')" />
            <x-text-input wire:model="form.location" id="location" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.location')" class="mt-2" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div>
                <x-input-label for="latitude" :value="__('Latitude (Optional)')" />
                <x-text-input wire:model="form.latitude" id="latitude" class="mt-1 block w-full" type="number" step="0.00000001" />
                <x-input-error :messages="$errors->get('form.latitude')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="longitude" :value="__('Longitude (Optional)')" />
                <x-text-input wire:model="form.longitude" id="longitude" class="mt-1 block w-full" type="number" step="0.00000001" />
                <x-input-error :messages="$errors->get('form.longitude')" class="mt-2" />
            </div>
        </div>

        <div class="mt-4">
            <x-input-label for="estimated_affected_population" :value="__('Estimated Affected Population')" />
            <x-text-input wire:model="form.estimated_affected_population" id="estimated_affected_population" class="mt-1 block w-full" type="number" min="0" />
            <x-input-error :messages="$errors->get('form.estimated_affected_population')" class="mt-2" />
        </div>

        <div class="mt-6 flex justify-end gap-3">
            <x-secondary-button wire:click="closeModal" type="button">Cancel</x-secondary-button>
            <x-primary-button type="submit">Save</x-primary-button>
        </div>
    </form>
</div>
