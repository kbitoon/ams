<div class="p-6 max-h-[90vh] overflow-y-auto">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    
    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-6">
        {{ $checklist ? 'Edit Checklist' : 'New Checklist' }}
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
                <x-input-label for="order" :value="__('Order')" />
                <x-text-input wire:model="form.order" id="order" class="mt-1 block w-full" type="number" min="0" />
                <x-input-error :messages="$errors->get('form.order')" class="mt-2" />
            </div>
        </div>

        <div class="mt-4">
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input wire:model="form.title" id="title" class="mt-1 block w-full" type="text" required />
            <x-input-error :messages="$errors->get('form.title')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="description" :value="__('Description')" />
            <textarea wire:model="form.description" id="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" rows="3"></textarea>
            <x-input-error :messages="$errors->get('form.description')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label :value="__('Checklist Items')" />
            <div class="mt-2 space-y-3">
                @foreach($form->items as $index => $item)
                    <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 border border-gray-200 dark:border-gray-700">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label :value="__('Item')" />
                                <x-text-input wire:model="form.items.{{ $index }}.item" class="mt-1 block w-full" type="text" placeholder="Checklist item..." />
                            </div>
                            <div>
                                <x-input-label :value="__('Order')" />
                                <x-text-input wire:model="form.items.{{ $index }}.order" class="mt-1 block w-full" type="number" min="0" />
                            </div>
                        </div>
                        <div class="mt-2">
                            <x-input-label :value="__('Description (Optional)')" />
                            <textarea wire:model="form.items.{{ $index }}.description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" rows="2"></textarea>
                        </div>
                        <div class="mt-2 flex items-center justify-between">
                            <label class="inline-flex items-center">
                                <input type="checkbox" wire:model="form.items.{{ $index }}.is_required" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Required</span>
                            </label>
                            <button type="button" wire:click="$parent.form.removeItem({{ $index }})" class="text-red-600 hover:text-red-800 dark:text-red-400">
                                <i class="fas fa-trash"></i> Remove
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
            <button type="button" wire:click="$parent.form.addItem()" class="mt-3 text-sm text-indigo-600 hover:text-indigo-800 dark:text-indigo-400">
                <i class="fas fa-plus mr-1"></i> Add Item
            </button>
            <x-input-error :messages="$errors->get('form.items')" class="mt-2" />
        </div>

        <div class="mt-4">
            <label class="inline-flex items-center">
                <input type="checkbox" wire:model="form.is_active" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Active</span>
            </label>
        </div>

        <div class="mt-6 flex justify-end gap-3">
            <x-secondary-button wire:click="closeModal" type="button">Cancel</x-secondary-button>
            <x-primary-button type="submit">Save Checklist</x-primary-button>
        </div>
    </form>
</div>
