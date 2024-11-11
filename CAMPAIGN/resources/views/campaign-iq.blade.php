<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
           Supporter
        </h2>
    </x-slot>

    @if (session('status'))
        <div class=" alert alert-success text-green-600" style="padding: 15px; border: 1px solid #c3e6cb; background-color: #d4edda; border-radius: 5px; margin-top: 10px;">
            {!! session('status') !!}
        </div>
    @endif
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
