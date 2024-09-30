<div class="p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none" wire:click="closeModal">
        &times;
    </button>
    <form wire:submit.prevent="save">
        <!-- Name input -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="form.name" id="name" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
        </div>

         <!-- Date acquired input -->
         <div class="mt-4">
                <x-input-label for="acquired" :value="__('Date Acquired')" />
                <x-input-date wire:model="form.acquired" id="acquired" class="mt-1 block w-full" type="text" />
                <x-input-error :messages="$errors->get('form.Acquired')" class="mt-2" />
        </div>

        <!-- Total Quantity input -->
        <div class="mt-4">
            <x-input-label for="TotalQuantity" :value="__('Total Quantity')" />
            <x-text-input wire:model="form.TotalQuantity" id="TotalQuantity" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.TotalQuantity')" class="mt-2" />
        </div>

         <!-- Quantity Left input -->
         <div class="mt-4">
            <x-input-label for="QuantityLeft" :value="__('Quantity Left')" />
            <x-text-input wire:model="form.QuantityLeft" id="QuantityLeft" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.QuantityLeft')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="category_id" :value="__('Category')" />
            <select wire:model="form.category_id" id="category_id" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option selected>Please select a category</option>
                @forelse($itemCategories as $itemCategory)
                    <option value="{{ $itemCategory->id }}">{{ $itemCategory->name }}</option>
                @empty
                   <option>No category available</option>
                @endforelse
            </select>
            <x-input-error :messages="$errors->get('form.category_id')" class="mt-2" />
        </div>

        <!-- Save button -->
        <div class="mt-4">
            <x-primary-button>
                Save
            </x-primary-button>
        </div>
    </form>
</div>
