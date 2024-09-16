<style>
.nav-link {
    display: inline-block;
    padding: 0.5rem 2rem;
    border-radius: 0.25rem;
    background-color: #f0f0f0;
    color: #333;
    text-decoration: none;
    transition: background-color 0.3s, color 0.3s, transform 0.3s;
    font-size: 1rem; /* Ensure font size is consistent */
    cursor: pointer;
    border: 1px solid #ddd;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.nav-link:hover {
    background-color: #e0e0e0;
    color: #000;
    transform: scale(1.05); /* Ensure transform is consistent */
}

.nav-link.active {
    background-color: #d0d0d0;
    color: #000;
}

.sections-container {
    margin-top: 1rem;
}

.sections-container .p-6 {
    padding: 1.5rem;
    color: #333;
    background-color: #ffffff;
    border: 1px solid #ddd;
    border-radius: 0.5rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.hidden {
    display: none;
}

 </style>   
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <livewire:layout.settings />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>