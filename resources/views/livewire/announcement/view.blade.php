<div class="min-w-full align-middle p-6 relative">
    <!-- Close button -->
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none" wire:click="closeModal">
        &times;
    </button>
    <div class="pt-3 sm:pt-5">
        <h2 class="text-xl font-semibold text-black dark:text-white">{{ $announcement->title }}</h2>

        <p class="mt-4 text-sm/relaxed">
            {!! $announcement->content !!}
        </p>
    </div>
</div>
