<style type="text/css">
    body {
    margin: 0;
    font-family: Arial, sans-serif;
}

.flex-container {
    display: flex;
    flex-direction: row;
    gap: 20px;
    flex-wrap: wrap;
}

.form-instructions, .form-container {
    flex: 1;
    padding: 20px;
    margin: 0 auto;
    max-width: 800px;
    line-height: 1.2;
    font-size: 13px;
}

.form-instructions center {
    display: block;
    text-align: center;
    margin-bottom: 20px;
}

.form-instructions ol,
.form-instructions ul {
    padding-left: 20px;
}

.form-instructions li {
    margin-bottom: 10px;
}

@media (max-width: 600px) {
    .flex-container {
        flex-direction: column;
    }

    .form-instructions {
        order: -1;
        padding: 10px;
    }

    .form-instructions ol,
    .form-instructions ul {
        padding-left: 15px;
    }

    .form-instructions li {
        font-size: 14px;
    }

    .form-container {
        padding: 10px;
    }
}

@media (min-width: 640px) {
    .sm\:max-w-md {
        max-width: 40rem !important;
    }

</style>
<x-app-layout>
    @auth
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Clearance Listing') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        @livewire('clearance')
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        @livewire('modals.clearance-modal')
                    </div>
                </div>
            </div>
        </div>
    @endauth
</x-app-layout>
