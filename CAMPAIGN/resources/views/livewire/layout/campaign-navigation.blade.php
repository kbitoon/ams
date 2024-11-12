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

        $this->redirect('/campaign/new-supporter', navigate: true);
    }
}; ?>


<nav x-data="{ open: false, dropdownOpen: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <div class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight">
                        <img src="/storage/public/campaign_iq_logo.png"/>
                    </div>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('campaign-iq')" :active="request()->routeIs('campaign-iq')" wire:navigate>
                        {{ __('Supporter') }}
                    </x-nav-link>
                    <x-nav-link :href="route('activity')" :active="request()->routeIs('activity')" wire:navigate>
                        {{ __('Activity') }}
                    </x-nav-link>
                    <x-nav-link :href="route('survey')" :active="request()->routeIs('survey')" wire:navigate>
                        {{ __('Survey') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6 pt-1">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ auth()->user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('settings')" :active="request()->routeIs('settings')" wire:navigate>
                            {{ __('Settings') }}
                        </x-dropdown-link>
                        <x-dropdown-link href="#" wire:click="logout">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
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
            <x-responsive-nav-link :href="route('campaign-iq')" :active="request()->routeIs('campaign-iq')" wire:navigate>
                {{ __('Supporter') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('activity')" :active="request()->routeIs('activity')" wire:navigate>
                {{ __('Activity') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('survey')" :active="request()->routeIs('survey')" wire:navigate>
                {{ __('Survey') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="sm:pt-4 sm:pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="mt-3 space-y-1">
                <!-- Show on larger screens -->
                <div class="hidden sm:flex sm:flex-col">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>{{ auth()->user()->name ?? 'Account' }}</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('settings')" :active="request()->routeIs('settings')" wire:navigate>
                                {{ __('Settings') }}
                            </x-dropdown-link>
                            <x-dropdown-link href="#" wire:click="logout">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>

    </div>
</nav>
