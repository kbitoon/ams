<div class="p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    
    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
        {{ $reliefItem ? 'Edit Relief Item' : 'Add Relief Item' }}
    </h2>

    <form wire:submit="save">
        <div class="mt-4">
            <x-input-label for="relief_operation_id" :value="__('Relief Operation')" />
            <select wire:model="form.relief_operation_id" id="relief_operation_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" @if($reliefItem) disabled @endif>
                <option value="">Select Operation</option>
                @foreach($operations as $operation)
                    <option value="{{ $operation->id }}">{{ $operation->title }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('form.relief_operation_id')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="relief_type_id" :value="__('Relief Type')" />
            <select wire:model="form.relief_type_id" id="relief_type_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="">Select Type</option>
                @foreach($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }} ({{ $type->unit }})</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('form.relief_type_id')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="provider_id" :value="__('Provider (Optional)')" />
            <select wire:model="form.provider_id" id="provider_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="">Select Provider</option>
                @foreach($providers as $provider)
                    <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('form.provider_id')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="quantity_received" :value="__('Quantity Received')" />
            <x-text-input wire:model="form.quantity_received" id="quantity_received" class="mt-1 block w-full" type="number" step="0.01" />
            <x-input-error :messages="$errors->get('form.quantity_received')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="unit_cost" :value="__('Unit Cost (Optional)')" />
            <x-text-input wire:model="form.unit_cost" id="unit_cost" class="mt-1 block w-full" type="number" step="0.01" />
            <x-input-error :messages="$errors->get('form.unit_cost')" class="mt-2" />
        </div>

        <div class="mt-6 flex justify-end gap-3">
            <x-secondary-button wire:click="closeModal" type="button">Cancel</x-secondary-button>
            <x-primary-button type="submit">Save</x-primary-button>
        </div>
    </form>
</div>

