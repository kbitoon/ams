<div class="p-6 ">
    @auth
        <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
            &times;
        </button>
    @endauth
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Hearing Form</h2>
    <form wire:submit="save">
        <!-- Name input -->
        <div>
            <x-input-label for="date_time" :value="__('Date and Time')" />
            <input type="datetime-local" wire:model="form.date_time" id="date_time" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <x-input-error :messages="$errors->get('form.date_time')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="type" :value="__('Type')" />
            <select wire:model="form.type" id="type" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option selected>Please select a type</option>
                    <option value="premediation">Premediation</option>
                    <option value="mediation">Mediation</option>
                    <option value="conciliation">Conciliation</option>
                    <option value="arbitration">Arbitration</option>
            </select>
            <x-input-error :messages="$errors->get('form.status')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="secretary" :value="__('Secretary')" />
            <x-text-input wire:model="form.secretary" id="secretary" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.secretary')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="presider" :value="__('Presider')" />
            <x-text-input wire:model="form.presider" id="presider" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.presider')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="remarks" :value="__('Remarks')" />
            <textarea wire:model="form.remarks" id="remarks" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="text" ></textarea>
            <x-input-error :messages="$errors->get('form.remarks')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="attachments" :value="__('Upload Images (multiple files allowed)')" />
            <input type="file" wire:model.defer="form.attachments" id="attachments" multiple
                accept="image/*,.pdf,.doc,.docx"
                class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-700 dark:file:bg-indigo-900/30 dark:file:text-indigo-300 hover:file:bg-indigo-100 dark:hover:file:bg-indigo-900/50">
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Select one or more images or documents.</p>
            <x-input-error :messages="$errors->get('form.attachments')" class="mt-2" />
        </div>

        <!-- Save button -->
        <div class="mt-4">
            <x-primary-button>
                Save
            </x-primary-button>
        </div>
    </form>
</div>



