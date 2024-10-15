<x-app-layout>
    @if (session('status'))
        <x-slot name="header">
            <div class="alert alert-success text-green-600" style="padding: 15px; border: 1px solid #c3e6cb; background-color: #d4edda; border-radius: 5px;">
                {!! session('status') !!}
                    <strong>Reference ID: <span style="background-color: rgba(74, 85, 104, 0.7); color: white; font-size: 1rem; font-weight: 600; padding: 0.25rem 0.5rem; border-radius: 10px">{{ session('reference_id') }}</span></strong>
                    <span style="display: inline; margin-top: 5px; font-size: 0.9em;">Use this ID to track for updates.</span>
            </div>
        </x-slot>
    @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <main class="mt-2">
                @livewire('welcome')
            </main>
            <footer class="py-16 text-center text-sm text-black dark:text-white/70">
            Copyright © 2024, Winston Pepito
            <p>
                Read our privacy policy <a href="http://www.barangaysystem.com/information/2">here</a>.
            </p>
            </footer>
        </div>
    </div>
</x-app-layout>

