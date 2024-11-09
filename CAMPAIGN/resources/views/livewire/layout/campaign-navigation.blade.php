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

            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <button wire:click="logout" class="w-full text-start">
                    <x-nav-link>
                        {{ __('Log Out') }}
                    </x-nav-link>
                </button>
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
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="mt-3 space-y-1">
                <button wire:click="logout" class="w-full text-start">
                        <x-nav-link>
                            {{ __('Log Out') }}
                        </x-nav-link>
                </button>
            </div>
        </div>
    </div>
</nav>
