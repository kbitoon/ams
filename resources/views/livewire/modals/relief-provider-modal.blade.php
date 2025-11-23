<div class="p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    
    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
        {{ $reliefProvider ? 'Edit Relief Provider' : 'New Relief Provider' }}
    </h2>

    <form wire:submit="save">
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="form.name" id="name" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="type" :value="__('Type')" />
            <select wire:model="form.type" id="type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="">Select Type</option>
                <option value="government">Government</option>
                <option value="ngo">NGO</option>
                <option value="private">Private</option>
                <option value="individual">Individual</option>
                <option value="other">Other</option>
            </select>
            <x-input-error :messages="$errors->get('form.type')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="contact_person" :value="__('Contact Person')" />
            <x-text-input wire:model="form.contact_person" id="contact_person" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.contact_person')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="contact_number" :value="__('Contact Number')" />
            <x-text-input wire:model="form.contact_number" id="contact_number" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.contact_number')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="form.email" id="email" class="mt-1 block w-full" type="email" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <label class="flex items-center">
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

