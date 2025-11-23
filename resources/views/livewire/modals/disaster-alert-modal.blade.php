<div class="p-6 max-h-[90vh] overflow-y-auto">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    
    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
        {{ $disasterAlert ? 'Edit Alert' : 'New Alert' }}
    </h2>

    <form wire:submit="save">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="disaster_event_id" :value="__('Disaster Event (Optional)')" />
                <select wire:model="form.disaster_event_id" id="disaster_event_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="">None (General Alert)</option>
                    @foreach($events as $event)
                        <option value="{{ $event->id }}">{{ $event->title }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('form.disaster_event_id')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="alert_type" :value="__('Alert Type')" />
                <select wire:model="form.alert_type" id="alert_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="advisory">Advisory</option>
                    <option value="watch">Watch</option>
                    <option value="warning">Warning</option>
                    <option value="evacuation">Evacuation</option>
                </select>
                <x-input-error :messages="$errors->get('form.alert_type')" class="mt-2" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
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

            <div>
                <x-input-label for="is_active" :value="__('Status')" />
                <label class="inline-flex items-center mt-2">
                    <input type="checkbox" wire:model="form.is_active" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Active</span>
                </label>
            </div>
        </div>

        <div class="mt-4">
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input wire:model="form.title" id="title" class="mt-1 block w-full" type="text" required />
            <x-input-error :messages="$errors->get('form.title')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="message" :value="__('Message')" />
            <textarea wire:model="form.message" id="message" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" rows="5" required></textarea>
            <x-input-error :messages="$errors->get('form.message')" class="mt-2" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div>
                <x-input-label for="issued_at" :value="__('Issued Date')" />
                <input type="date" wire:model="form.issued_at" id="issued_at" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                <x-input-error :messages="$errors->get('form.issued_at')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="issued_time" :value="__('Issued Time')" />
                <input type="time" wire:model="form.issued_time" id="issued_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                <x-input-error :messages="$errors->get('form.issued_time')" class="mt-2" />
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <div>
                <x-input-label for="expires_at" :value="__('Expires Date (Optional)')" />
                <input type="date" wire:model="form.expires_at" id="expires_at" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <x-input-error :messages="$errors->get('form.expires_at')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="expires_time" :value="__('Expires Time (Optional)')" />
                <input type="time" wire:model="form.expires_time" id="expires_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <x-input-error :messages="$errors->get('form.expires_time')" class="mt-2" />
            </div>
        </div>

        <div class="mt-6 flex justify-end gap-3">
            <x-secondary-button wire:click="closeModal" type="button">Cancel</x-secondary-button>
            <x-primary-button type="submit">Save Alert</x-primary-button>
        </div>
    </form>
</div>
