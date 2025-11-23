<div class="p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    
    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
        {{ $reliefOperation ? 'Edit Relief Operation' : 'New Relief Operation' }}
    </h2>

    <form wire:submit="save">
        <div class="mt-4">
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input wire:model="form.title" id="title" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.title')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="purpose" :value="__('Purpose')" />
            <x-text-input wire:model="form.purpose" id="purpose" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.purpose')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="description" :value="__('Description')" />
            <textarea wire:model="form.description" id="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
            <x-input-error :messages="$errors->get('form.description')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="operation_date" :value="__('Operation Date')" />
            <input type="date" wire:model="form.operation_date" id="operation_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            <x-input-error :messages="$errors->get('form.operation_date')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="provider_id" :value="__('Relief Provider (Optional)')" />
            <select wire:model="form.provider_id" id="provider_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="">Select Provider</option>
                @foreach($providers as $provider)
                    <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('form.provider_id')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="status" :value="__('Status')" />
            <select wire:model="form.status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="active">Active</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
            <x-input-error :messages="$errors->get('form.status')" class="mt-2" />
        </div>

        <div class="mt-4">
            <label class="flex items-center">
                <input type="checkbox" wire:model="form.is_per_family" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Distribute per family</span>
            </label>
        </div>

        <div class="mt-6 flex justify-end gap-3">
            <x-secondary-button wire:click="closeModal" type="button">Cancel</x-secondary-button>
            <x-primary-button type="submit">Save</x-primary-button>
        </div>
    </form>
</div>

