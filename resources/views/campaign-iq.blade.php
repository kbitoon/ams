<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <img src="/storage/public/campaign_iq_logo.png" />
        </h2>
    </x-slot>
@auth
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @livewire('campaign-iq')
                </div>
            </div>
        </div>
    </div>

    @else
    <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        @livewire('modals.campaign-iq-modal')
                    </div>
                </div>
            </div>
        </div>
    @endauth
    <div style="text-align: center">
        <p class="font-semibold text-sm text-gray-800 dark:text-gray-200 leading-tight">
            Copyright &copy; 2024, Winston Pepito
        </p>
    </div>
</x-app-layout>
