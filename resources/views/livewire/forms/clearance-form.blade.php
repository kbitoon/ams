<div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-h-[90vh] overflow-y-auto">
    <!-- Header -->
    <div class="sticky top-0 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-4 sm:px-6 py-4 flex items-center justify-between z-10">
        <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-gray-100">
            {{ $clearance ? 'Edit Clearance' : 'New Clearance Request' }}
        </h2>
        @auth
            <button 
                wire:click="closeModal"
                class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500"
                title="Close">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        @endauth
    </div>

    <div class="p-4 sm:p-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Form -->
            <div class="lg:col-span-2 space-y-6">
                <form wire:submit="save" class="space-y-6">
                    <!-- Personal Information Section -->
                    <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                            Personal Information
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="sm:col-span-2">
                                <x-input-label for="name" :value="__('Full Name')" />
                                <x-text-input wire:model="form.name" id="name" class="mt-1 block w-full" type="text" placeholder="Enter your full name" />
                                <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
                                <input type="date" wire:model="form.date_of_birth" id="date_of_birth" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                                <x-input-error :messages="$errors->get('form.date_of_birth')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="sex" :value="__('Gender')" />
                                <select wire:model="form.sex" id="sex" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <option value="">Select your Gender</option>
                                    <option value="Female">Female</option>
                                    <option value="Male">Male</option>
                                </select>
                                <x-input-error :messages="$errors->get('form.sex')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="civil_status" :value="__('Civil Status')" />
                                <select wire:model="form.civil_status" id="civil_status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <option value="">Select your Civil Status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Separated">Separated</option>
                                    <option value="Other">Other</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('form.civil_status')" />
                            </div>

                            <div>
                                <x-input-label for="precinct_no" :value="__('Precinct No.')" />
                                <x-text-input wire:model="form.precinct_no" id="precinct_no" class="mt-1 block w-full" type="text" placeholder="Optional" />
                                <x-input-error :messages="$errors->get('form.precinct_no')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- Contact Information Section -->
                    <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                            Contact Information
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <x-input-label for="contact_number" :value="__('Contact Number')" />
                                <x-text-input wire:model="form.contact_number" id="contact_number" class="mt-1 block w-full" type="text" placeholder="11-digit mobile number" />
                                <x-input-error :messages="$errors->get('form.contact_number')" class="mt-2" />
                            </div>
                            
                            <div>
                                <x-input-label for="address" :value="__('Complete Address')" />
                                <textarea wire:model="form.address" id="address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Enter your complete address"></textarea>
                                <x-input-error :messages="$errors->get('form.address')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- Clearance Details Section -->
                    <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                            Clearance Details
                        </h3>
                        <div class="space-y-4">
                            <div>
                                <x-input-label for="type_id" :value="__('Clearance Type')" />
                                <select wire:model.live.debounce.500ms="form.type_id" id="type_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                                    <option value="">Select a Clearance Type</option>
                                    @forelse($clearanceTypes as $clearanceType)
                                        <option value="{{ $clearanceType->id }}">{{ $clearanceType->name }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <x-input-error :messages="$errors->get('form.type_id')" class="mt-2" />
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="amount" :value="__('Amount')" />
                                    <div class="mt-1 relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">₱</span>
                                        </div>
                                        <x-text-input wire:model="form.amount" id="amount" class="block w-full pl-7" type="text" readonly/>
                                    </div>
                                    <x-input-error :messages="$errors->get('form.amount')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="date" :value="__('Date')" />
                                    <input type="date" wire:model="form.date" id="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                                    <x-input-error :messages="$errors->get('form.date')" class="mt-2" />
                                </div>
                            </div>

                            <div>
                                <x-input-label for="purpose" :value="__('Purpose')" />
                                <x-text-input wire:model.live.debounce.500ms="form.purpose" id="purpose" class="mt-1 block w-full" type="text" placeholder="Enter the purpose of this clearance" />
                                <x-input-error :messages="$errors->get('form.purpose')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="notes" :value="__('Notes')" />
                                <textarea wire:model="form.notes" id="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="Additional notes (optional)"></textarea>
                                <x-input-error :messages="$errors->get('form.notes')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <!-- Requirements Section -->
                    @if($requirement)
                    <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-4 sm:p-5 border border-blue-200 dark:border-blue-800">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-blue-600 dark:text-blue-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                            </svg>
                            Requirements
                        </h3>
                        <div class="text-sm text-gray-700 dark:text-gray-300 prose prose-sm max-w-none dark:prose-invert">
                            {!! $requirement !!}
                        </div>
                    </div>
                    @endif

                    <!-- Attachments Section -->
                    <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                            Attachments
                        </h3>
                        <div>
                            <label for="attachments" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Upload Files
                            </label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg hover:border-indigo-400 dark:hover:border-indigo-500 transition-colors">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                        <label for="attachments" class="relative cursor-pointer rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2">
                                            <span>Upload files</span>
                                            <input wire:model="form.attachments" id="attachments" type="file" class="sr-only" multiple />
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, PDF up to 10MB</p>
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('form.attachments')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                        @auth
                            <x-secondary-button type="button" wire:click="closeModal">
                                Cancel
                            </x-secondary-button>
                        @endauth
                        <x-primary-button type="submit" class="min-w-[120px]">
                            <span wire:loading.remove wire:target="save">Submit Request</span>
                            <span wire:loading wire:target="save" class="flex items-center gap-2">
                                <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Submitting...
                            </span>
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <!-- Instructions Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-gradient-to-br from-indigo-50 to-blue-50 dark:from-indigo-900/20 dark:to-blue-900/20 rounded-lg p-5 sm:p-6 border border-indigo-200 dark:border-indigo-800 sticky top-20">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-indigo-600 dark:text-indigo-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                        </svg>
                        Important Information
                    </h3>
                    <div class="text-sm text-gray-700 dark:text-gray-300 space-y-3 [&_ul]:list-disc [&_ul]:ml-5 [&_ul]:my-3 [&_ul]:space-y-1 [&_li]:my-1 [&_p]:my-2 [&_p]:leading-relaxed [&_strong]:text-indigo-600 dark:[&_strong]:text-indigo-400">
                        {!! $instructions ?? '<p>No instructions available.</p>' !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(function() {
    // Fetch dynamic tags from a server-side source
    $.ajax({
        url: '/clearancepurpose', // Replace with your endpoint
        method: 'GET',
        success: function(data) {
            // Assuming `data` is an array of objects with a 'purpose' property
            var purposes = data.map(function(item) {
                return item.purpose;
            });

            $("#purpose").autocomplete({
                source: purposes,
                select: function(event, ui) {
                    // Replace the existing value with the selected value
                    $("#purpose").val(ui.item.value);
                    return false; // Prevent the default behavior of autocomplete
                }
            });
        },
        error: function(error) {
            console.error("Error fetching tags:", error);
        }
    });
});
</script>
