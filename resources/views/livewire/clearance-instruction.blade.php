<div class="p-6">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                    Edit Clearance Instructions
                </h2>
            </div>

            @if (session()->has('message'))
                <div class="mb-4 p-4 bg-green-100 dark:bg-green-900/20 border border-green-400 dark:border-green-800 text-green-700 dark:text-green-300 rounded-lg">
                    {{ session('message') }}
                </div>
            @endif

            <form wire:submit="save" class="space-y-6">
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Instructions Content
                    </label>
                    <textarea
                        wire:model="content"
                        id="content"
                        rows="15"
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="Enter instructions content (HTML allowed)"
                    ></textarea>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        You can use HTML tags for formatting. The content will be displayed in the clearance form sidebar.
                    </p>
                    @error('content')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <x-primary-button type="submit" class="min-w-[120px]">
                        <span wire:loading.remove wire:target="save">Save Changes</span>
                        <span wire:loading wire:target="save" class="flex items-center gap-2">
                            <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Saving...
                        </span>
                    </x-primary-button>
                </div>
            </form>

            <!-- Preview Section -->
            <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Preview</h3>
                <div class="bg-gradient-to-br from-indigo-50 to-blue-50 dark:from-indigo-900/20 dark:to-blue-900/20 rounded-lg p-5 border border-indigo-200 dark:border-indigo-800">
                    <div class="text-sm text-gray-700 dark:text-gray-300 prose prose-sm max-w-none dark:prose-invert">
                        {!! $content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

