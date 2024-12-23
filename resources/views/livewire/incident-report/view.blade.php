<div class="min-w-full align-middle p-6 relative">
    <!-- Close button -->
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    <div class="pt-3 sm:pt-5">
        <h2 class="text-xl font-semibold text-black dark:text-white">
            {{ $incidentReport->title }}
            <span class="block text-gray-500 dark:text-gray-400" style="font-size: 0.65rem;">
                {{$incidentReport->name}} | {{ \Carbon\Carbon::parse($incidentReport->date)->format('F j, Y') }}
            </span>
        </h2>

        <p class="mt-4 text-sm/relaxed overflow-auto max-h-60 sm:max-h-80" style="word-wrap: break-word;">
            {!! $incidentReport->narration !!}
        </p>
    </div>
</div>
