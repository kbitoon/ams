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
                
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-20">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                    @livewire('user-statistics')
                    
                    <!-- Photo Upload Section -->
                    <div class="mt-20">
                        <h3 class="text-lg font-semibold">Upload Banner Photo</h3>
                        <form method="POST" action="{{ route('photo.upload') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mt-4">
                                <input type="file" name="photo" accept="image/*" required class="border border-gray-300 rounded p-2">
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="nav-link">Upload</button>
                            </div>
                        </form>

                        <!-- Display success or error message -->
                        @if (session('message'))
                            <div class="mt-4 text-green-600">
                                {{ session('message') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="mt-4 text-red-600">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
