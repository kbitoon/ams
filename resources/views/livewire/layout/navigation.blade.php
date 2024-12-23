<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
{{--                    <a href="{{ route('dashboard') }}" wire:navigate>--}}
{{--                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />--}}
{{--                    </a>--}}
                    <div class="inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-red-100 rounded-full dark:bg-red-600">
                        <a href="/">
                        {{--                            <span class="font-medium text-gray-600 dark:text-gray-300">BIS</span> --}}
                        <img src="/storage/logo.png" />
                        </a>
                    </div>
                </div>


                
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                @unlessrole('user|anonymous')
                    <x-nav-link :href="route('todo')" :active="request()->routeIs('todo')" wire:navigate>
                            {{ __('Tasks')}}
                    </x-nav-link>
                @endunlessrole

                    <!-- Clearance Dropdown -->
                        <x-nav-link :href="route('clearance')" :active="request()->routeIs('clearance')" wire:navigate>
                            {{ __('Clearances') }}
                        </x-nav-link>


                    <!-- Announcement Dropdown -->
                        <x-nav-link :href="route('announcement')" :active="request()->routeIs('announcement')" wire:navigate>
                            {{ __('Announcements') }}
                        </x-nav-link>


                    @hasanyrole('user|anonymous')
                        <x-nav-link :href="route('information')" :active="request()->routeIs('information')" wire:navigate>
                            {{ __('Information') }}
                        </x-nav-link>
                    @endhasanyrole
                    @hasanyrole('superadmin|administrator|tanod|lupon')
                    <div class="hidden sm:flex sm:items-center sm:ml-6 pt-1  ">
                        <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                        <div>Information</div>

                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                        <x-dropdown-link :href="route('information')" :active="request()->routeIs('information')" wire:navigate>
                                            {{ __('Listing') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link :href="route('incident-report')" :active="request()->routeIs('incident-report')" wire:navigate>
                                            {{ __('Incident Report') }}
                                        </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                    </div>        
                    @endhasanyrole
                    @hasanyrole('user|anonymous')
                        <x-nav-link :href="route('complaint')" :active="request()->routeIs('complaint')" wire:navigate>
                            {{ __('Complaints') }}
                        </x-nav-link>
                    @endhasanyrole

                    @hasanyrole('superadmin|administrator|tanod|lupon')
                    <div class="hidden sm:flex sm:items-center sm:ml-6 pt-1  ">
                        <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                        <div>Complaints</div>

                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                        <x-dropdown-link :href="route('complaint')" :active="request()->routeIs('complaint')" wire:navigate>
                                            {{ __('Listing') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link :href="route('blotter')" :active="request()->routeIs('blotter')" wire:navigate>
                                            {{ __('Blotter Report') }}
                                        </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                    </div>        
                    @endhasanyrole

                    <div class="hidden sm:flex sm:items-center sm:ml-6 pt-1 ">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                    <div>Schedules</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('vehicle-schedule')" :active="request()->routeIs('vehicle-schedule')" wire:navigate>
                                        {{ __('Vehicles') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('facility-schedule')" :active="request()->routeIs('facility-schedule')" wire:navigate>
                                    {{ __('Facilities') }}
                                </x-dropdown-link>
                                @hasanyrole('superadmin|administrator|support')
                                <x-dropdown-link :href="route('activity')" :active="request()->routeIs('activity')" wire:navigate>
                                    {{ __('Activities') }}
                                </x-dropdown-link>
                                
                                <x-dropdown-link :href="route('item-schedule')" :active="request()->routeIs('item-schedule')" wire:navigate>
                                    {{ __('Equipments') }}
                                </x-dropdown-link>
                                @else
                                @endhasanyrole
                                
                            </x-slot>
                        </x-dropdown>
                    </div>
                    
                    @hasanyrole('superadmin|administrator|support')
                        <div class="hidden sm:flex sm:items-center sm:ml-6 pt-1 ">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                        <div>Inventory</div>

                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    
                                    <x-dropdown-link :href="route('vehicle-listing')" :active="request()->routeIs('vehicle-listing')" wire:navigate>
                                        {{ __('Vehicles') }}
                                    </x-dropdown-link>

                                    <x-dropdown-link :href="route('item')" :active="request()->routeIs('item')" wire:navigate>
                                        {{ __('Equipments') }}
                                    </x-dropdown-link>

                                    <x-dropdown-link :href="route('facility')" :active="request()->routeIs('facility')" wire:navigate>
                                        {{ __('Facilities') }}
                                    </x-dropdown-link>
                                    
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @else
                    @endhasanyrole
                </div>
            </div>


            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <img class="w-10 h-9 rounded-full" src="{{ auth()->user()->photoUrl() }}">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        @hasanyrole('superadmin')
                        <button wire:click="" class="w-full text-start">
                        <x-dropdown-link :href="route('user-management')" wire:navigate>
                            {{ __('User Management') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('driver')" :active="request()->routeIs('driver')" wire:navigate>
                            {{ __('Driver') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('settings')" wire:navigate>
                        
                            {{ __('Settings') }}
                        </x-dropdown-link>
                    @else
                    @endhasanyrole

                        <!-- Authentication -->
                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('todo')" :active="request()->routeIs('todo')" wire:navigate>
                {{ __('Tasks') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('clearance')" :active="request()->routeIs('clearance')" wire:navigate>
                {{ __('Clearances') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('announcement')" :active="request()->routeIs('announcement')" wire:navigate>
                {{ __('Announcements') }}
            </x-responsive-nav-link>
            @hasanyrole('user | anonymous')
            <x-responsive-nav-link :href="route('information')" :active="request()->routeIs('information')" wire:navigate>
                {{ __('Information') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('complaint')" :active="request()->routeIs('complaint')" wire:navigate>
                {{ __('Complaints') }}
            </x-responsive-nav-link>
            @else
            @endhasanyrole

        @hasanyrole('superadmin|administrator|tanod|lupon')
        <div x-data="{ open: false }">
            <button @click="open = !open" class="w-full text-left px-4 py-2 rounded-md bg-white dark:bg-zinc-900">
                {{ __('Informations') }}
                <svg class="inline w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div x-show="open" @click.away="open = false" class="mt-2 space-y-1">
                 <x-responsive-nav-link :href="route('information')" :active="request()->routeIs('information')" wire:navigate>
                    {{ __('Listing') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('incident-report')" :active="request()->routeIs('incident-report')" wire:navigate>
                    {{ __('Incident Report') }}
                </x-responsive-nav-link>
            </div>
        </div>
        <div x-data="{ open: false }">
            <button @click="open = !open" class="w-full text-left px-4 py-2 rounded-md bg-white dark:bg-zinc-900">
                {{ __('Complaints') }}
                <svg class="inline w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div x-show="open" @click.away="open = false" class="mt-2 space-y-1">
                 <x-responsive-nav-link :href="route('complaint')" :active="request()->routeIs('complaint')" wire:navigate>
                    {{ __('Listing') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('blotter')" :active="request()->routeIs('blotter')" wire:navigate>
                    {{ __('Blotter Report') }}
                </x-responsive-nav-link>
            </div>
        </div>
        @else
        @endhasanyrole
            
        @hasanyrole('superadmin|administrator|support|user')
        <!-- Schedule Dropdown -->
        <div x-data="{ open: false }">
            <button @click="open = !open" class="w-full text-left px-4 py-2 rounded-md bg-white dark:bg-zinc-900">
                {{ __('Schedule') }}
                <svg class="inline w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div x-show="open" @click.away="open = false" class="mt-2 space-y-1">
                 <x-responsive-nav-link :href="route('activity')" :active="request()->routeIs('activity')" wire:navigate>
                    {{ __('Activities') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('vehicle-schedule')" :active="request()->routeIs('vehicle-schedule')" wire:navigate>
                    {{ __('Vehicles') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('item-schedule')" :active="request()->routeIs('item-schedule')" wire:navigate>
                    {{ __('Equipments') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('facility-schedule')" :active="request()->routeIs('facility-schedule')" wire:navigate>
                    {{ __('Facilities') }}
                </x-responsive-nav-link>
            </div>
        </div>

        <!-- Inventory Dropdown -->
        <div x-data="{ open: false }">
            <button @click="open = !open" class="w-full text-left px-4 py-2 rounded-md bg-white dark:bg-zinc-900">
                {{ __('Inventory') }}
                <svg class="inline w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            <div x-show="open" @click.away="open = false" class="mt-2 space-y-1">
                <x-responsive-nav-link :href="route('vehicle-listing')" :active="request()->routeIs('vehicle-listing')" wire:navigate>
                    {{ __('Vehicles') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('item')" :active="request()->routeIs('item')" wire:navigate>
                    {{ __('Equipments') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('facility')" :active="request()->routeIs('facility')" wire:navigate>
                    {{ __('Facilities') }}
                </x-responsive-nav-link>
            </div>
        </div>
        @else
        @endhasanyrole
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile')" wire:navigate>
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                @hasanyrole('superadmin|administrator')
                <x-responsive-nav-link :href="route('user-management')" wire:navigate>
                    {{ __('User Management') }}
                </x-responsive-nav-link>
                @endhasanyrole
                <!-- Authentication -->
                <button wire:click="logout" class="w-full text-start">
                    <x-responsive-nav-link>
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>
