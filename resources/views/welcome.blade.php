<x-app-layout>
    @if (session('status'))
        <x-slot name="header">
            <div class="alert alert-success text-green-600" style="padding: 15px; border: 1px solid #c3e6cb; background-color: #d4edda; border-radius: 5px;">
                {!! session('status') !!}
                <div style="margin-top: 10px;">
                    <strong>Reference ID: <span style='font-size: 1.2em; color: black;'>{{ session('reference_id') }}</span></strong>
                    <span style="display: block; margin-top: 5px; font-size: 0.9em;">Use this ID to track for updates.</span>
                </div>
            </div>
        </x-slot>
    @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <main class="mt-2">
                @livewire('welcome')
            </main>
            <footer class="py-16 text-center text-sm text-black dark:text-white/70">
            Copyright © Winston Pepito, 2024
            </footer>
        </div>
    </div>
</x-app-layout>

