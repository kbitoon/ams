<div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-h-[90vh] overflow-y-auto">
    <!-- Sticky Header -->
    <div class="sticky top-0 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-4 sm:px-6 py-4 flex items-center justify-between z-10">
        <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-gray-100">
            {{ $incidentReport ? 'Edit Incident Report' : 'New Incident Report' }}
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
    <form wire:submit="save" class="px-4 sm:px-6 py-5 sm:py-6">
        <div class="space-y-6">
            <!-- Title Section -->
            <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                    Incident Details
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                    <!-- Title -->
                    <div class="md:col-span-2">
                        <x-input-label for="title" :value="__('Title')" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
                        <x-text-input 
                            wire:model="form.title" 
                            id="title" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" 
                            type="text"
                            placeholder="Enter incident title..."
                        />
                        <x-input-error :messages="$errors->get('form.title')" class="mt-2" />
                    </div>

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
                        <x-text-input 
                            wire:model="form.name" 
                            id="name" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="Enter name..."
                        />
                        <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
                    </div>

                    <!-- Date -->
                    <div>
                        <x-input-label for="date" :value="__('Date')" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
                        <input 
                            wire:model="form.date" 
                            id="date" 
                            type="date"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        />
                        <x-input-error :messages="$errors->get('form.date')" class="mt-2" />
                    </div>
                </div>
            </div>

            <!-- Image Upload Section -->
            <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                    Image (Optional)
                </h3>
                
                <div>
                    @if($form->image)
                        <div class="mb-3">
                            <img src="{{ $form->image->temporaryUrl() }}" alt="Preview" class="max-w-full h-48 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
                        </div>
                        <button type="button" wire:click="$set('form.image', null)" class="text-sm text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                            Remove Image
                        </button>
                    @elseif($form->existing_image)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $form->existing_image) }}" alt="Current Image" class="max-w-full h-48 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
                        </div>
                        <button type="button" wire:click="form.removeImage" class="text-sm text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                            Remove Image
                        </button>
                    @endif
                    <input 
                        type="file" 
                        wire:model="form.image" 
                        id="image" 
                        accept="image/*"
                        class="mt-2 block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-indigo-900 dark:file:text-indigo-200"
                    />
                    <x-input-error :messages="$errors->get('form.image')" class="mt-2" />
                </div>

                <!-- Image Position Selection -->
                @if($form->image || $form->existing_image)
                <div class="mt-4">
                    <x-input-label for="image_position" :value="__('Image Position')" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
                    <select wire:model="form.image_position" id="image_position" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="before">Before Narration</option>
                        <option value="after">After Narration</option>
                    </select>
                    <x-input-error :messages="$errors->get('form.image_position')" class="mt-2" />
                </div>
                @endif
            </div>

            <!-- Narration Section -->
            <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                    Narration
                </h3>
                
                <div>
                    <x-input-label for="narration" :value="__('Narration of Incident')" class="text-sm font-medium text-gray-700 dark:text-gray-300" />
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
                    {{ $incidentReport ? 'Update' : 'Submit' }}
                </span>
                <span wire:loading wire:target="save" class="flex items-center gap-2">
                    <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    {{ $incidentReport ? 'Updating...' : 'Submitting...' }}
                </span>
            </x-primary-button>
        </div>
    </form>
</div>
