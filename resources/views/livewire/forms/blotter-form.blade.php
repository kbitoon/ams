<div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-h-[90vh] overflow-y-auto">
    <!-- Sticky Header -->
    <div class="sticky top-0 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-4 sm:px-6 py-4 flex items-center justify-between z-10">
        <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-gray-100">
            {{ $blotter ? 'Edit Blotter' : 'New Blotter' }}
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
    <form wire:submit.prevent="save" class="px-4 sm:px-6 py-5 sm:py-6">
        <div class="space-y-6">
            <!-- Incident Information Section -->
            <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                    Incident Information
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                    <!-- Date and Time of Reported -->
                    <div>
                        <x-input-label for="reported" :value="__('Date and Time of Reported *')" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
                        <input 
                            type="datetime-local" 
                            wire:model="form.reported" 
                            id="reported" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        />
                        <x-input-error :messages="$errors->get('form.reported')" class="mt-2" />
                    </div>

                    <!-- Date and Time of Incident -->
                    <div>
                        <x-input-label for="incident" :value="__('Date and Time of Incident *')" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
                        <input 
                            type="datetime-local" 
                            wire:model="form.incident" 
                            id="incident" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        />
                        <x-input-error :messages="$errors->get('form.incident')" class="mt-2" />
                    </div>

                    <!-- Place of Incident -->
                    <div class="md:col-span-2">
                        <x-input-label for="place" :value="__('Place of Incident *')" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
                        <x-text-input 
                            wire:model="form.place" 
                            id="place" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="Enter place of incident..."
                        />
                        <x-input-error :messages="$errors->get('form.place')" class="mt-2" />
                    </div>
                </div>
            </div>

            <!-- Complainant Information Section -->
            <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    Complainant Information
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                    <!-- First Name -->
                    <div>
                        <x-input-label for="firstname" :value="__('First Name *')" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
                        <x-text-input 
                            wire:model="form.firstname" 
                            id="firstname" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="Enter first name..."
                        />
                        <x-input-error :messages="$errors->get('form.firstname')" class="mt-2" />
                    </div>

                    <!-- Last Name -->
                    <div>
                        <x-input-label for="lastname" :value="__('Last Name *')" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
                        <x-text-input 
                            wire:model="form.lastname" 
                            id="lastname" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="Enter last name..."
                        />
                        <x-input-error :messages="$errors->get('form.lastname')" class="mt-2" />
                    </div>

                    <!-- Middle Name -->
                    <div>
                        <x-input-label for="middle" :value="__('Middle Name *')" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
                        <x-text-input 
                            wire:model="form.middle" 
                            id="middle" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="Enter middle name..."
                        />
                        <x-input-error :messages="$errors->get('form.middle')" class="mt-2" />
                    </div>

                    <!-- Contact -->
                    <div>
                        <x-input-label for="contact" :value="__('Contact Number *')" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
                        <x-text-input 
                            wire:model="form.contact" 
                            id="contact" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="Enter contact number..."
                        />
                        <x-input-error :messages="$errors->get('form.contact')" class="mt-2" />
                    </div>

                    <!-- Civil Status -->
                    <div>
                        <x-input-label for="civil" :value="__('Civil Status *')" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
                        <select 
                            wire:model="form.civil" 
                            id="civil" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        >
                            <option value="">Select civil status...</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Widowed">Widowed</option>
                            <option value="Divorced">Divorced</option>
                            <option value="Separated">Separated</option>
                        </select>
                        <x-input-error :messages="$errors->get('form.civil')" class="mt-2" />
                    </div>

                    <!-- Date of Birth -->
                    <div>
                        <x-input-label for="date_of_birth" :value="__('Date of Birth *')" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
                        <input 
                            type="date" 
                            wire:model="form.date_of_birth" 
                            id="date_of_birth" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        />
                        <x-input-error :messages="$errors->get('form.date_of_birth')" class="mt-2" />
                    </div>

                    <!-- Address -->
                    <div class="md:col-span-2">
                        <x-input-label for="address" :value="__('Address *')" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
                        <x-text-input 
                            wire:model="form.address" 
                            id="address" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="Enter complete address..."
                        />
                        <x-input-error :messages="$errors->get('form.address')" class="mt-2" />
                    </div>
                </div>
            </div>

            <!-- Additional Information Section -->
            <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12v-.008z" />
                    </svg>
                    Additional Information (Optional)
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                    <!-- Place of Birth -->
                    <div>
                        <x-input-label for="place_of_birth" :value="__('Place of Birth')" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
                        <x-text-input 
                            wire:model="form.place_of_birth" 
                            id="place_of_birth" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="Enter place of birth..."
                        />
                        <x-input-error :messages="$errors->get('form.place_of_birth')" class="mt-2" />
                    </div>

                    <!-- Occupation -->
                    <div>
                        <x-input-label for="occupation" :value="__('Occupation')" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
                        <x-text-input 
                            wire:model="form.occupation" 
                            id="occupation" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="Enter occupation..."
                        />
                        <x-input-error :messages="$errors->get('form.occupation')" class="mt-2" />
                    </div>
                </div>
            </div>

            <!-- Narration Section -->
            <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                    Narration of Incident
                </h3>
                
                <div>
                    <x-input-label for="narration" :value="__('Narration *')" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
                    <textarea 
                        wire:model="form.narration" 
                        id="narration" 
                        rows="6"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white resize-y"
                        placeholder="Provide a detailed narration of the incident..."
                    ></textarea>
                    <x-input-error :messages="$errors->get('form.narration')" class="mt-2" />
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="mt-6 flex flex-col-reverse sm:flex-row justify-end gap-3 pt-6 border-t border-gray-200 dark:border-gray-700">
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
                    {{ $blotter ? 'Update' : 'Submit' }}
                </span>
                <span wire:loading wire:target="save" class="flex items-center gap-2">
                    <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    {{ $blotter ? 'Updating...' : 'Submitting...' }}
                </span>
            </x-primary-button>
        </div>
    </form>
</div>
