<x-app-layout>
    @if (session('status'))
        <x-slot name="header">
            <div class="alert alert-success text-green-600">
                {{ session('status') }}
            </div>
        </x-slot>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <main class="mt-6">
                @livewire('welcome')
            </main>
            <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </footer>
        </div>
    </div>
</x-app-layout>

