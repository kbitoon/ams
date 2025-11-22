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
                {{ __('Clearances') }}
            </h2>
        </x-slot>

        <div class="py-6 sm:py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100" x-data="{ activeTab: 'list' }">
                        <!-- Tab Navigation -->
                        <div class="mb-6 border-b border-gray-200 dark:border-gray-700">
                            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                                <button
                                    @click="activeTab = 'list'"
                                    :class="activeTab === 'list' 
                                        ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' 
                                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300'"
                                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors"
                                >
                                    {{ __('List') }}
                                </button>
                                @hasanyrole('superadmin|administrator|support')
                                <button
                                    @click="activeTab = 'reports'"
                                    :class="activeTab === 'reports' 
                                        ? 'border-indigo-500 text-indigo-600 dark:text-indigo-400' 
                                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300'"
                                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors"
                                >
                                    {{ __('Reports') }}
                                </button>
                                @endhasanyrole
                            </nav>
                        </div>

                        <!-- Tab Content -->
                        <div>
                            <div x-show="activeTab === 'list'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                                @livewire('clearance')
                            </div>
                            @hasanyrole('superadmin|administrator|support')
                            <div x-show="activeTab === 'reports'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                                @livewire('clearance-report')
                            </div>
                            @endhasanyrole
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
    @if (session('status'))
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class=" alert alert-success text-green-600" style="padding: 15px; border: 1px solid #c3e6cb; background-color: #d4edda; border-radius: 5px; margin-top: 10px;">
                    {!! session('status') !!}
                </div>
            </div>
        @endif
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
