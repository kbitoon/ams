<div class="p-6">
    <form wire:submit.prevent="save">
        <div class="mt-4">
            <x-input-label for="location" :value="__('Location')" />
            <x-text-input wire:model="form.location" id="location" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.location')" class="mt-2" />
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
            <x-input-label for="quantity" :value="__('Quantity')" />
            <x-text-input wire:model="form.quantity" id="quantity" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.quantity')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="item_id" :value="__('Item')" />
            <select wire:model="form.item_id" id="item_id" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option selected>Please select an item</option>
                @forelse($items as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @empty
                    <option>No Item available</option>
                @endforelse
            </select>
            <x-input-error :messages="$errors->get('form.item_id')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="purpose" :value="__('Purpose')" />
            <x-text-input  wire:model="form.purpose" id="purpose" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.purpose')" class="mt-2" />
        </div>

        <!-- Save button -->
        <div class="mt-4">
            <x-primary-button>
                Save
            </x-primary-button>
        </div>
    </form>
</div>
