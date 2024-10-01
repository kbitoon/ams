<div class="min-w-full align-middle p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    <div class="pt-3 sm:pt-5">
        <h2 class="text-xl font-semibold text-black dark:text-white">{{ $information->title }}</h2>

        <p class="mt-4 text-sm/relaxed">
            {!! $information->content !!}
        </p>
    </div>
</div>
