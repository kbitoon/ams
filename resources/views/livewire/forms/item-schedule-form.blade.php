<div class="p-6 max-w-lg mx-auto">
    <form wire:submit.prevent="save">
        <!-- Location Input -->
        <div class="mt-4">
            <x-input-label for="location" :value="__('Location')" />
            <x-text-input wire:model="form.location" id="location" class="mt-1 block w-full" type="text" />
        </div>

        <!-- Start DateTime Input -->
        <div class="mt-4">
            <x-input-label for="start" :value="__('Start')" />
            <input type="datetime-local" wire:model="form.start" id="start" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
        </div>

        <!-- End DateTime Input -->
        <div class="mt-4">
            <x-input-label for="end" :value="__('End')" />
            <input type="datetime-local" wire:model="form.end" id="end" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
        </div>

        <!-- Dynamic Item Inputs -->
        <div class="mt-4">
            <x-input-label :value="__('Equipments')" />
            @foreach($form->items as $index => $item)
                <div class="flex gap-2 mt-2">
                    <select wire:model="form.items.{{ $index }}.item_id" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Select an Equipment</option>
                        @foreach($items as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <x-text-input wire:model="form.items.{{ $index }}.quantity" class="w-1/3" type="number" min="1"  placeholder="Qty"/>
                </div>
            @endforeach
            <button type="button" wire:click="addItem" class="mt-2 text-blue-500">+ Add Equipment</button>
        </div>

        <!-- Purpose Input -->
        <div class="mt-4">
            <x-input-label for="purpose" :value="__('Purpose')" />
            <textarea wire:model="form.purpose" id="purpose" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
        </div>

        <!-- Assigned To Input -->
        <div class="mt-4">
            <x-input-label for="assigned" :value="__('Assigned To')" />
            <x-text-input wire:model="form.assigned" id="assigned" class="mt-1 block w-full" type="text" />
        </div>

        <div class="mt-4">
            <x-primary-button>Save</x-primary-button>
        </div>
    </form>
</div>

