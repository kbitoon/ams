<div class="p-6 ">
    @auth
        <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
            &times;
        </button>
    @endauth

    <h2 class="text-xl font-semibold text-gray-800 mb-4">Summon Form</h2>
    <form wire:submit="save">
        <!-- Name input -->

        <div>
            <x-input-label for="date_time" :value="__('Date and Time')" />
            <input type="datetime-local" wire:model="form.date_time" id="date_time" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="text" ></nput>
            <x-input-error :messages="$errors->get('form.date_time')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="received_by" :value="__('Received by')" />
            <x-text-input wire:model="form.received_by" id="received_by" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.received_by')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="served_by" :value="__('Serve by')" />
            <x-text-input wire:model="form.served_by" id="served_by" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.served_by')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="remarks" :value="__('Remarks')" />
            <textarea wire:model="form.remarks" id="remarks" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="text" ></textarea>
            <x-input-error :messages="$errors->get('form.remarks')" class="mt-2" />
        </div>

        <!-- Save button -->
        <div class="mt-4">
            <x-primary-button>
                Save
            </x-primary-button>
        </div>
    </form>
</div>



