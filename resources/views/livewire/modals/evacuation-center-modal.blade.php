<div class="p-6 max-h-[90vh] overflow-y-auto">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    
    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
        {{ $evacuationCenter ? 'Edit Evacuation Center' : 'New Evacuation Center' }}
    </h2>

    <form wire:submit="save">
        <div class="mt-4">
            <x-input-label for="name" :value="__('Center Name')" />
            <x-text-input wire:model="form.name" id="name" class="mt-1 block w-full" type="text" required />
            <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" />
            <textarea wire:model="form.address" id="address" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" rows="3" required></textarea>
            <x-input-error :messages="$errors->get('form.address')" class="mt-2" />
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
            <x-input-label for="capacity" :value="__('Capacity (Max Persons)')" />
            <x-text-input wire:model="form.capacity" id="capacity" class="mt-1 block w-full" type="number" min="1" required />
            <x-input-error :messages="$errors->get('form.capacity')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="contact_person_id" :value="__('Contact Person (Optional)')" />
            <div class="relative">
                <input
                    type="text"
                    id="contact_person_id"
                    wire:model.live.debounce.300ms="contactSearch"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    placeholder="Search contact person..."
                    autocomplete="off"
                />
                
                @if($form->contact_person_id)
                    @php
                        $selectedContact = \App\Models\User::find($form->contact_person_id);
                    @endphp
                    @if($selectedContact)
                        <div class="mt-1 text-xs text-gray-600 dark:text-gray-400">
                            Selected: <span class="font-medium">{{ $selectedContact->name }}</span>
                        </div>
                    @endif
                @endif

                @if($contactSearch && $filteredContacts->count() > 0 && !$form->contact_person_id)
                    <div class="absolute z-50 w-full mt-1 bg-white dark:bg-gray-800 rounded-md shadow-lg border border-gray-200 dark:border-gray-700 max-h-60 overflow-auto">
                        <ul class="py-1">
                            @foreach($filteredContacts as $user)
                                <li>
                                    <button
                                        type="button"
                                        wire:click="selectContact({{ $user->id }})"
                                        class="w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700"
                                    >
                                        <div class="font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</div>
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <x-input-error :messages="$errors->get('form.contact_person_id')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="contact_number" :value="__('Contact Number (Optional)')" />
            <x-text-input wire:model="form.contact_number" id="contact_number" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.contact_number')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label :value="__('Facilities (Optional)')" />
            <div class="mt-2 space-y-2">
                @php
                    $facilityOptions = ['water', 'electricity', 'toilets', 'medical', 'kitchen', 'parking', 'wifi'];
                @endphp
                @foreach($facilityOptions as $facility)
                    <label class="inline-flex items-center">
                        <input type="checkbox" wire:model="form.facilities" value="{{ $facility }}" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ ucfirst($facility) }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="mt-4">
            <label class="inline-flex items-center">
                <input type="checkbox" wire:model="form.is_active" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Active</span>
            </label>
        </div>

        <div class="mt-6 flex justify-end gap-3">
            <x-secondary-button wire:click="closeModal" type="button">Cancel</x-secondary-button>
            <x-primary-button type="submit">Save</x-primary-button>
        </div>
    </form>
</div>
