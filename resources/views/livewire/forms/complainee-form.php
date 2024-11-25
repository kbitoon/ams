<div class="p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>

    <form wire:submit="save">
        <div>
            <x-input-label for="firstname" :value="__('First Name')" />
            <x-text-input wire:model="form.firstname" id="firstname" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.firstname')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="lastname" :value="__('Last Name')" />
            <x-text-input wire:model="form.lastname" id="lastname" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.lastname')" class="mt-2" />
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
            <x-input-label for="civil" :value="__('Civil Status')" />
            <x-text-input wire:model="form.civil" id="civil" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.civil')" class="mt-2" />
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

        <div>
            <x-input-label for="influence" :value="__('Under the Influence?')" />

            <div class="mt-1 space-y-2">
 
                    <label class="flex items-center">
                        <input
                            wire:model="form.influence"
                            id="influence-no"
                            type="radio"
                            value="No"
                            class="text-indigo-600 border-gray-300 focus:ring-indigo-500"
                        />
                        <span class="ml-2 text-gray-700">{{ __('No') }}</span>
                    </label>

                    <label class="flex items-center">
                        <input
                            wire:model="form.influence"
                            id="influence-drugs"
                            type="radio"
                            value="Drugs"
                            class="text-indigo-600 border-gray-300 focus:ring-indigo-500"
                        />
                        <span class="ml-2 text-gray-700">{{ __('Drugs') }}</span>
                    </label>

                    <label class="flex items-center">
                        <input
                            wire:model="form.influence"
                            id="influence-liquor"
                            type="radio"
                            value="Liquor"
                            class="text-indigo-600 border-gray-300 focus:ring-indigo-500"
                        />
                        <span class="ml-2 text-gray-700">{{ __('Liquor') }}</span>
                    </label>
                </div>
                <x-input-error :messages="$errors->get('form.influence')" class="mt-2" />
        </div>


        <div class="mt-4">
            <x-primary-button> 
                Save
            </x-primary-button>
        </div>
    </form>
</div>