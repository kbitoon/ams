<div class="p-6 max-w-7xl mx-auto">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>

    <form wire:submit="save" class="space-y-4">
        <div class="grid grid-cols-2 gap-4">
            <!-- Date and Time of Reported -->
            <div class="mt-4">
                <x-input-label for="reported" :value="__('Date and Time of Reported *')" />
                <x-input-datetime wire:model="form.reported" id="reported" class="mt-1 block w-full" type="text" />
                <x-input-error :messages="$errors->get('form.reported')" class="mt-2" />
            </div>

            <!-- Date and Time of Incident -->
            <div class="mt-4">
                <x-input-label for="incident" :value="__('Date and Time of Incident *')" />
                <x-input-datetime wire:model="form.incident" id="incident" class="mt-1 block w-full" type="text" />
                <x-input-error :messages="$errors->get('form.incident')" class="mt-2" />
            </div>

            <!-- Place of Incident -->
            <div class="mt-4">
                <x-input-label for="place" :value="__('Place of Incident *')" />
                <x-text-input wire:model="form.place" id="place" class="mt-1 block w-full" type="text" />
                <x-input-error :messages="$errors->get('form.place')" class="mt-2" />
            </div>

            <!-- First Name -->
            <div class="mt-4">
                <x-input-label for="firstname" :value="__('First Name *')" />
                <x-text-input wire:model="form.firstname" id="firstname" class="mt-1 block w-full" type="text" />
                <x-input-error :messages="$errors->get('form.firstname')" class="mt-2" />
            </div>

            <!-- Last Name -->
            <div class="mt-4">
                <x-input-label for="lastname" :value="__('Last Name *')" />
                <x-text-input wire:model="form.lastname" id="lastname" class="mt-1 block w-full" type="text" />
                <x-input-error :messages="$errors->get('form.lastname')" class="mt-2" />
            </div>

            <!-- Middle Name -->
            <div class="mt-4">
                <x-input-label for="middle" :value="__('Middle Name *')" />
                <x-text-input wire:model="form.middle" id="middle" class="mt-1 block w-full" type="text" />
                <x-input-error :messages="$errors->get('form.middle')" class="mt-2" />
            </div>

            <!-- Contact -->
            <div class="mt-4">
                <x-input-label for="contact" :value="__('Contact *')" />
                <x-text-input wire:model="form.contact" id="contact" class="mt-1 block w-full" type="text" />
                <x-input-error :messages="$errors->get('form.contact')" class="mt-2" />
            </div>

            <!-- Civil Status -->
            <div class="mt-4">
                <x-input-label for="civil" :value="__('Civil Status *')" />
                <x-text-input wire:model="form.civil" id="civil" class="mt-1 block w-full" type="text" />
                <x-input-error :messages="$errors->get('form.civil')" class="mt-2" />
            </div>

            <!-- Date of Birth -->
            <div class="mt-4">
                <x-input-label for="date_of_birth" :value="__('Date of Birth *')" />
                <x-input-date wire:model="form.date_of_birth" id="date_of_birth" class="mt-1 block w-full" type="text" />
                <x-input-error :messages="$errors->get('form.date_of_birth')" class="mt-2" />
            </div>

            <!-- Address -->
            <div class="mt-4">
                <x-input-label for="address" :value="__('Address *')" />
                <x-text-input wire:model="form.address" id="address" class="mt-1 block w-full" type="text" />
                <x-input-error :messages="$errors->get('form.address')" class="mt-2" />
            </div>

            <!-- Place of Birth -->
            <div class="mt-4">
                <x-input-label for="place_of_birth" :value="__('Place of Birth')" />
                <x-text-input wire:model="form.place_of_birth" id="place_of_birth" class="mt-1 block w-full" type="text" />
                <x-input-error :messages="$errors->get('form.place_of_birth')" class="mt-2" />
            </div>

            <!-- Occupation -->
            <div class="mt-4">
                <x-input-label for="occupation" :value="__('Occupation')" />
                <x-text-input wire:model="form.occupation" id="occupation" class="mt-1 block w-full" type="text" />
                <x-input-error :messages="$errors->get('form.occupation')" class="mt-2" />
            </div>

            <!-- Narration -->
            
        </div>
        <div class="mt-4">
                <x-input-label for="narration" :value="__('Narration of Incident *')" />
                <textarea wire:model="form.narration" id="narration" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                <x-input-error :messages="$errors->get('form.narration')" class="mt-2" />
            </div>
        <!-- Submit Button -->
        <div class="mt-4">
            <x-primary-button> 
                Save
            </x-primary-button>
        </div>
    </form>
</div>
