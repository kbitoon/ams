@hasanyrole('superadmin|administrator|support')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User and Role Management') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Tabs Container -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="p-4 sm:p-6">
                    <div x-data="{ openTab: 1 }">
                        <!-- Tab Buttons -->
                        <div class="flex space-x-1 border-b border-gray-200 dark:border-gray-700 mb-6">
                            <button 
                                :class="openTab === 1 ? 'border-b-2 border-indigo-500 text-indigo-600 dark:text-indigo-400 font-medium' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300'" 
                                @click="openTab = 1" 
                                class="py-3 px-6 text-sm font-medium transition-colors">
                                Users
                            </button>
                            <button 
                                :class="openTab === 2 ? 'border-b-2 border-indigo-500 text-indigo-600 dark:text-indigo-400 font-medium' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300'" 
                                @click="openTab = 2" 
                                class="py-3 px-6 text-sm font-medium transition-colors">
                                Roles
                            </button>
                            <button 
                                :class="openTab === 3 ? 'border-b-2 border-indigo-500 text-indigo-600 dark:text-indigo-400 font-medium' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300'" 
                                @click="openTab = 3" 
                                class="py-3 px-6 text-sm font-medium transition-colors">
                                Families
                            </button>
                        </div>
                        
                        <!-- Tab Content -->
                        <div x-show="openTab === 1" class="mt-4">
                            @livewire('user')
                        </div>
                        <div x-show="openTab === 2" class="mt-4">
                            @livewire('role')
                        </div>
                        <div x-show="openTab === 3" class="mt-4">
                            @livewire('family')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@else
@endhasanyrole