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
{{--                    <a href="/">--}}
{{--                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />--}}
{{--                    </a>--}}
                    <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-red-100 rounded-full dark:bg-red-600">
                        <a href="/">
                        {{--    <span class="font-medium text-gray-600 dark:text-gray-300">BIS</span> --}}
                            <img src="/storage/public/logo.png" />
                        </a>
                    </div>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('get-a-clearance')" :active="request()->routeIs('get-a-clearance')" wire:navigate>
                        {{ __('Get a Clearance') }}
                    </x-nav-link>

                    <x-nav-link :href="route('file-a-complaint')" :active="request()->routeIs('file-a-complaint')" wire:navigate>
                        {{ __('Request or Complaint') }}
                    </x-nav-link>

                    <x-nav-link :href="route('information')" :active="request()->routeIs('information')" wire:navigate>
                        {{ __('Information') }}
                    </x-nav-link>

{{--                    <x-nav-link :href="route('todo')" :active="request()->routeIs('todo')" wire:navigate>--}}
{{--                        {{ __('Submit a Feedback') }}--}}
{{--                    </x-nav-link>--}}
                </div>
            </div>

            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                    {{ __('Login') }}
                </x-nav-link>

                @if (Route::has('register'))
                    <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                        {{ __('Register') }}
                    </x-nav-link>
                @endif
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
            <x-responsive-nav-link :href="route('todo')" :active="request()->routeIs('todo')" wire:navigate>
                {{ __('Get a Clearance') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('todo')" :active="request()->routeIs('todo')" wire:navigate>
                {{ __('Request or Complaint') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('todo')" :active="request()->routeIs('todo')" wire:navigate>
                {{ __('Submit a Feedback') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('login')" wire:navigate>
                    {{ __('Login') }}
                </x-responsive-nav-link>

                @if (Route::has('register'))
                    <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')">
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                @endif
            </div>
        </div>
    </div>
</nav>
