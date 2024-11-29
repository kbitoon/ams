<div class="p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>

    <form wire:submit="save" class="grid grid-cols-2 gap-4">
        <div>
            <x-input-label for="first" :value="__('First Name *')" />
            <x-text-input wire:model="form.first" id="first" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.first')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="last" :value="__('Last Name *')" />
            <x-text-input wire:model="form.last" id="last" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.last')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="middle" :value="__('Middle Name')" />
            <x-text-input wire:model="form.middle" id="middle" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.middle')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="contact" :value="__('Contact Number')" />
            <x-text-input wire:model="form.contact" id="contact" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.contact')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="civil_status" :value="__('Civil Status')" />
            <x-text-input wire:model="form.civil_status" id="civil_status" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.civil_status')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
            <x-input-date wire:model="form.date_of_birth" id="date_of_birth" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.date_of_birth')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="place_of_birth" :value="__('Place of Birth')" />
            <x-text-input wire:model="form.place_of_birth" id="place_of_birth" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.place_of_birth')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input wire:model="form.address" id="address" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.address')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="occupation" :value="__('Occupation')" />
            <x-text-input wire:model="form.occupation" id="occupation" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.occupation')" class="mt-2" />
        </div>

        <div class="col-span-2">
            <x-input-label for="influence" :value="__('Under the Influence?')" />
            <div class="mt-1 flex space-x-4">
                <div class="flex items-center">
                    <input
                        wire:model="form.influence"
                        id="influence-no"
                        type="radio"
                        value="No"
                        class="text-indigo-600 border-gray-300 focus:ring-indigo-500"
                    />
                    <span class="ml-2 text-gray-700">No</span>
                </div>

                <div class="flex items-center">
                    <input
                        wire:model="form.influence"
                        id="influence-drugs"
                        type="radio"
                        value="Drugs"
                        class="text-indigo-600 border-gray-300 focus:ring-indigo-500"
                    />
                    <span class="ml-2 text-gray-700">Drugs</span>
                </div>

                <div class="flex items-center">
                    <input
                        wire:model="form.influence"
                        id="influence-liquor"
                        type="radio"
                        value="Liquor"
                        class="text-indigo-600 border-gray-300 focus:ring-indigo-500"
                    />
                    <span class="ml-2 text-gray-700">Liquor</span>
                </div>
            </div>
            <x-input-error :messages="$errors->get('form.influence')" class="mt-2" />
        </div>

        <div class="col-span-2 text-right mt-4">
            <x-primary-button> 
                Save
            </x-primary-button>
        </div>
    </form>
</div>
