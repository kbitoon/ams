@hasanyrole('superadmin')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User and Role Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Tabs Container -->
            <div class="bg-white overflow-hidden sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div x-data="{ openTab: 1 }">
                        <!-- Tab Buttons -->
                        <div class="flex space-x-4 border-b">
                            <button 
                                :class="openTab === 1 ? 'border-b-2 font-medium text-blue-500' : 'text-gray-500'" 
                                @click="openTab = 1" 
                                class="py-2 px-4">
                                Users
                            </button>
                            <button 
                                :class="openTab === 2 ? 'border-b-2 font-medium text-blue-500' : 'text-gray-500'" 
                                @click="openTab = 2" 
                                class="py-2 px-4">
                                Roles
                            </button>
                        </div>
                        
                        <!-- Tab Content -->
                        <div x-show="openTab === 1" class="mt-4">
                            @livewire('user')
                        </div>
                        <div x-show="openTab === 2" class="mt-4">
                            @livewire('role')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@else
@endhasanyrole