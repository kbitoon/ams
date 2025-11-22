<div x-data="{ activeTab: 'clearance-type-section' }">
    <!-- Tab Navigation -->
    <div class="mb-6">
        <!-- Desktop Tabs -->
        <div class="hidden md:block border-b border-gray-200 dark:border-gray-700">
            <nav class="-mb-px flex space-x-8 overflow-x-auto" aria-label="Tabs">
                <button
                    @click="activeTab = 'clearance-type-section'"
                    :class="activeTab === 'clearance-type-section' 
                        ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' 
                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors"
                >
                    {{ __('Clearance Type') }}
                </button>
                <button
                    @click="activeTab = 'announcement-category-section'"
                    :class="activeTab === 'announcement-category-section' 
                        ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' 
                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors"
                >
                    {{ __('Announcement Category') }}
                </button>
                <button
                    @click="activeTab = 'information-category-section'"
                    :class="activeTab === 'information-category-section' 
                        ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' 
                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors"
                >
                    {{ __('Information Category') }}
                </button>
                <button
                    @click="activeTab = 'complaint-category-section'"
                    :class="activeTab === 'complaint-category-section' 
                        ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' 
                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors"
                >
                    {{ __('Complaint Category') }}
                </button>
                <button
                    @click="activeTab = 'item-category-section'"
                    :class="activeTab === 'item-category-section' 
                        ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' 
                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors"
                >
                    {{ __('Item Category') }}
                </button>
                <button
                    @click="activeTab = 'pdf-content-section'"
                    :class="activeTab === 'pdf-content-section' 
                        ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' 
                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors"
                >
                    {{ __('PDF Content') }}
                </button>
                <button
                    @click="activeTab = 'user-statistics-section'"
                    :class="activeTab === 'user-statistics-section' 
                        ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' 
                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors"
                >
                    {{ __('User Statistics') }}
                </button>
                @hasanyrole('superadmin')
                <button
                    @click="activeTab = 'clearance-instructions-section'"
                    :class="activeTab === 'clearance-instructions-section' 
                        ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' 
                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors"
                >
                    {{ __('Clearance Instructions') }}
                </button>
                @endhasanyrole
                <button
                    @click="activeTab = 'banner-photo-section'"
                    :class="activeTab === 'banner-photo-section' 
                        ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' 
                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300'"
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors"
                >
                    {{ __('Banner Photo') }}
                </button>
            </nav>
        </div>

        <!-- Mobile Dropdown -->
        <div class="md:hidden">
            <select
                x-model="activeTab"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
            >
                <option value="clearance-type-section">{{ __('Clearance Type') }}</option>
                <option value="announcement-category-section">{{ __('Announcement Category') }}</option>
                <option value="information-category-section">{{ __('Information Category') }}</option>
                <option value="complaint-category-section">{{ __('Complaint Category') }}</option>
                <option value="item-category-section">{{ __('Item Category') }}</option>
                <option value="pdf-content-section">{{ __('PDF Content') }}</option>
                <option value="user-statistics-section">{{ __('User Statistics') }}</option>
                @hasanyrole('superadmin')
                <option value="clearance-instructions-section">{{ __('Clearance Instructions') }}</option>
                @endhasanyrole
                <option value="banner-photo-section">{{ __('Banner Photo') }}</option>
            </select>
        </div>
    </div>

    <!-- Tab Content -->
    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg overflow-hidden">
        <!-- Clearance Type -->
        <div x-show="activeTab === 'clearance-type-section'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="p-4 sm:p-6">
            @livewire('clearance-type')
        </div>

        <!-- Announcement Category -->
        <div x-show="activeTab === 'announcement-category-section'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="p-4 sm:p-6">
            @livewire('announcement-category')
        </div>

        <!-- Information Category -->
        <div x-show="activeTab === 'information-category-section'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="p-4 sm:p-6">
            @livewire('information-category')
        </div>

        <!-- Complaint Category -->
        <div x-show="activeTab === 'complaint-category-section'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="p-4 sm:p-6">
            @livewire('complaint-category')
        </div>

        <!-- Item Category -->
        <div x-show="activeTab === 'item-category-section'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="p-4 sm:p-6">
            @livewire('item-category')
        </div>

        <!-- PDF Content -->
        <div x-show="activeTab === 'pdf-content-section'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="p-4 sm:p-6">
            @livewire('pdf-content')
        </div>

        <!-- User Statistics -->
        <div x-show="activeTab === 'user-statistics-section'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="p-4 sm:p-6">
            @livewire('user-statistics')
        </div>

        <!-- Clearance Instructions (Superadmin Only) -->
        @hasanyrole('superadmin')
        <div x-show="activeTab === 'clearance-instructions-section'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="p-4 sm:p-6">
            @livewire('clearance-instruction-editor')
        </div>
        @endhasanyrole

        <!-- Banner Photo Upload -->
        <div x-show="activeTab === 'banner-photo-section'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="p-4 sm:p-6">
            <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-indigo-600 dark:text-indigo-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                    </svg>
                    Upload Banner Photo
                </h3>
                <form method="POST" action="{{ route('photo.upload') }}" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label for="photo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Select Image
                        </label>
                        <input 
                            type="file" 
                            name="photo" 
                            id="photo"
                            accept="image/*" 
                            required 
                            class="block w-full text-sm text-gray-500 dark:text-gray-400
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-indigo-50 file:text-indigo-700
                                hover:file:bg-indigo-100
                                dark:file:bg-indigo-900/20 dark:file:text-indigo-300
                                dark:hover:file:bg-indigo-900/30"
                        >
                        <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                            Accepted formats: JPG, PNG, GIF. Maximum file size: 10MB
                        </p>
                    </div>
                    <div>
                        <x-primary-button type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 inline">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                            </svg>
                            Upload Photo
                        </x-primary-button>
                    </div>

                    @if (session('message'))
                        <div class="p-4 bg-green-100 dark:bg-green-900/20 border border-green-400 dark:border-green-800 text-green-700 dark:text-green-300 rounded-lg">
                            {{ session('message') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="p-4 bg-red-100 dark:bg-red-900/20 border border-red-400 dark:border-red-800 text-red-700 dark:text-red-300 rounded-lg">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
