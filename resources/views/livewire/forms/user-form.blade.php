<div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-h-[90vh] overflow-y-auto">
    <!-- Sticky Header -->
    <div class="sticky top-0 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-4 sm:px-6 py-4 flex items-center justify-between z-10">
        <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-gray-100">
            {{ $form->user ? 'Edit User' : 'New User' }}
        </h2>
        <button 
            wire:click="closeModal"
            class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500 flex-shrink-0"
            title="Close">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Form Content -->
    <form wire:submit.prevent="save" class="px-4 sm:px-6 py-5 sm:py-6 space-y-6">
        <!-- Account Information Section -->
        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
                Account Information
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                <div>
                    <x-input-label for="name" :value="__('Name *')" />
                    <x-text-input wire:model="form.name" id="name" class="mt-1 block w-full" type="text" />
                    <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="email" :value="__('Email *')" />
                    <x-text-input wire:model="form.email" id="email" class="mt-1 block w-full" type="email" />
                    <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
                </div>

                <div class="md:col-span-2">
                    <x-input-label for="roles" :value="__('Role')" />
                    <select wire:model="form.roles" id="roles" class="mt-1 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">{{ __('Select a Role') }}</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('form.roles')" class="mt-2" />
                </div>
            </div>
        </div>

        <!-- Personal Information Section -->
        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0z" />
                </svg>
                Personal Information
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                <div>
                    <x-input-label for="contact_number" :value="__('Contact Number')" />
                    <x-text-input wire:model="form.contact_number" id="contact_number" class="mt-1 block w-full" type="text" />
                    <x-input-error :messages="$errors->get('form.contact_number')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="birthdate" :value="__('Birthdate')" />
                    <x-text-input wire:model="form.birthdate" id="birthdate" class="mt-1 block w-full" type="date" />
                    <x-input-error :messages="$errors->get('form.birthdate')" class="mt-2" />
                </div>

                <div class="md:col-span-2">
                    <x-input-label for="address" :value="__('Address')" />
                    <x-text-input wire:model="form.address" id="address" class="mt-1 block w-full" type="text" />
                    <x-input-error :messages="$errors->get('form.address')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="sitio" :value="__('Sitio')" />
                    <x-text-input wire:model="form.sitio" id="sitio" class="mt-1 block w-full" type="text" />
                    <x-input-error :messages="$errors->get('form.sitio')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="blood_type" :value="__('Blood Type')" />
                    <x-text-input wire:model="form.blood_type" id="blood_type" class="mt-1 block w-full" type="text" />
                    <x-input-error :messages="$errors->get('form.blood_type')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="willing_blood_donor" :value="__('Willing Blood Donor')" />
                    <div class="flex items-center mt-1">
                        <label class="mr-4">
                            <input type="radio" wire:model="form.willing_blood_donor" name="form.willing_blood_donor" value="Yes" class="mr-1">
                            Yes
                        </label>
                        <label>
                            <input type="radio" wire:model="form.willing_blood_donor" name="form.willing_blood_donor" value="No" class="mr-1">
                            No
                        </label>
                    </div>
                    <x-input-error :messages="$errors->get('form.willing_blood_donor')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="occupation" :value="__('Occupation')" />
                    <x-text-input wire:model="form.occupation" id="occupation" class="mt-1 block w-full" type="text" />
                    <x-input-error :messages="$errors->get('form.occupation')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="income" :value="__('Income')" />
                    <x-text-input wire:model="form.income" id="income" class="mt-1 block w-full" type="number" step="0.01" />
                    <x-input-error :messages="$errors->get('form.income')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="civil_status" :value="__('Civil Status')" />
                    <select wire:model="form.civil_status" id="civil_status" class="mt-1 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Select Civil Status</option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Divorced">Divorced</option>
                        <option value="Widowed">Widowed</option>
                        <option value="Separated">Separated</option>
                        <option value="Other">Other</option>
                    </select>
                    <x-input-error :messages="$errors->get('form.civil_status')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="education" :value="__('Education')" />
                    <select wire:model="form.education" id="education" class="mt-1 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Select Education Level</option>
                        <option value="Bachelor">Bachelor</option>
                        <option value="Some College">Some College</option>
                        <option value="Highschool">Highschool</option>
                        <option value="Elementary">Elementary</option>
                        <option value="Other">Other</option>
                    </select>
                    <x-input-error :messages="$errors->get('form.education')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="financial_assistance" :value="__('Financial Assistance')" />
                    <select wire:model="form.financial_assistance" id="financial_assistance" class="mt-1 w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Select Financial Assistance Type</option>
                        <option value="PWD">PWD</option>
                        <option value="Senior Citizen">Senior Citizen</option>
                        <option value="Social Pensioner">Social Pensioner</option>
                        <option value="4Ps">4Ps</option>
                    </select>
                    <x-input-error :messages="$errors->get('form.financial_assistance')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="living_in_danger_zone" :value="__('Living in Danger Zone')" />
                    <div class="flex items-center mt-1">
                        <label class="mr-4">
                            <input type="radio" wire:model="form.living_in_danger_zone" name="form.living_in_danger_zone" value="True" class="mr-1">
                            True
                        </label>
                        <label>
                            <input type="radio" wire:model="form.living_in_danger_zone" name="form.living_in_danger_zone" value="False" class="mr-1">
                            False
                        </label>
                    </div>
                    <x-input-error :messages="$errors->get('form.living_in_danger_zone')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="registered_voter" :value="__('Registered Voter')" />
                    <div class="flex items-center mt-1">
                        <label class="mr-4">
                            <input type="radio" wire:model="form.registered_voter" name="form.registered_voter" value="Yes" class="mr-1">
                            Yes
                        </label>
                        <label>
                            <input type="radio" wire:model="form.registered_voter" name="form.registered_voter" value="No" class="mr-1">
                            No
                        </label>
                    </div>
                    <x-input-error :messages="$errors->get('form.registered_voter')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="weight" :value="__('Weight (kg)')" />
                    <x-text-input wire:model="form.weight" id="weight" class="mt-1 block w-full" type="number" step="0.01" />
                    <x-input-error :messages="$errors->get('form.weight')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="height" :value="__('Height (cm)')" />
                    <x-text-input wire:model="form.height" id="height" class="mt-1 block w-full" type="number" step="0.01" />
                    <x-input-error :messages="$errors->get('form.height')" class="mt-2" />
                </div>
            </div>
        </div>

        <!-- Family Information Section -->
        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.645-5.888-1.664a3.001 3.001 0 00-4.682 2.72 9.097 9.097 0 003.741.488m-11.5-3.68c.01.103.022.207.037.31.074.196.232.354.428.428a10.07 10.07 0 005.394 0c.196-.074.354-.232.428-.428a9.148 9.148 0 00.037-.31m-11.5-3.68a9.505 9.505 0 0111.5 0M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                </svg>
                Family Information
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                <div>
                    <x-input-label for="father_firstname" :value="__('Father\'s First Name')" />
                    <x-text-input wire:model="form.father_firstname" id="father_firstname" class="mt-1 block w-full" type="text" />
                    <x-input-error :messages="$errors->get('form.father_firstname')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="father_lastname" :value="__('Father\'s Last Name')" />
                    <x-text-input wire:model="form.father_lastname" id="father_lastname" class="mt-1 block w-full" type="text" />
                    <x-input-error :messages="$errors->get('form.father_lastname')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="mother_firstname" :value="__('Mother\'s First Name')" />
                    <x-text-input wire:model="form.mother_firstname" id="mother_firstname" class="mt-1 block w-full" type="text" />
                    <x-input-error :messages="$errors->get('form.mother_firstname')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="mother_lastname" :value="__('Mother\'s Last Name')" />
                    <x-text-input wire:model="form.mother_lastname" id="mother_lastname" class="mt-1 block w-full" type="text" />
                    <x-input-error :messages="$errors->get('form.mother_lastname')" class="mt-2" />
                </div>
            </div>
        </div>

        <!-- Emergency Contact Section -->
        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.69a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                </svg>
                Emergency Contact
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                <div>
                    <x-input-label for="emergency_contact_person" :value="__('Contact Person')" />
                    <x-text-input wire:model="form.emergency_contact_person" id="emergency_contact_person" class="mt-1 block w-full" type="text" />
                    <x-input-error :messages="$errors->get('form.emergency_contact_person')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="emergency_contact_number" :value="__('Contact Number')" />
                    <x-text-input wire:model="form.emergency_contact_number" id="emergency_contact_number" class="mt-1 block w-full" type="text" />
                    <x-input-error :messages="$errors->get('form.emergency_contact_number')" class="mt-2" />
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex flex-col-reverse sm:flex-row justify-end gap-3 pt-6 border-t border-gray-200 dark:border-gray-700">
            <x-secondary-button
                type="button"
                wire:click="closeModal"
                class="w-full sm:w-auto">
                Cancel
            </x-secondary-button>
            <x-primary-button
                type="submit"
                wire:loading.attr="disabled"
                class="w-full sm:w-auto">
                <span wire:loading.remove wire:target="save">
                    {{ $form->user ? 'Update User' : 'Create User' }}
                </span>
                <span wire:loading wire:target="save" class="flex items-center gap-2">
                    <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    {{ $form->user ? 'Updating...' : 'Creating...' }}
                </span>
            </x-primary-button>
        </div>
    </form>
</div>
