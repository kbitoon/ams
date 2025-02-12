<div class="p-6 ">
    @auth
        <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
            &times;
        </button>
    @endauth
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Complainant Form</h2>
    <form wire:submit.prevent="save">
        <!-- Name input -->

        <div>
            <x-input-label for="firstname" :value="__('First Name')" />
            <x-text-input wire:model="form.firstname" id="firstname" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.firstname')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="middlename" :value="__('Middle Name')" />
            <x-text-input wire:model="form.middlename" id="middlename" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.middlename')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="lastname" :value="__('Last Name')" />
            <x-text-input wire:model="form.lastname" id="lastname" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.lastname')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="contact_number" :value="__('Contact Number')" />
            <x-text-input wire:model="form.contact_number" id="contact_number" class="mt-1 block w-full" type="text" />
            <x-input-error :messages="$errors->get('form.contact_number')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" />
            <textarea wire:model="form.address" id="address" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="text" ></textarea>
            <x-input-error :messages="$errors->get('form.addresscomplaint')" class="mt-2" />
        </div>
        <!-- Save button -->
        <div class="mt-4">
            <x-primary-button>
                Save
            </x-primary-button>
        </div>
    </form>
</div>



