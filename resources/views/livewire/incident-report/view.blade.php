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

        <!-- Image Before Narration -->
        @if($incidentReport->image_path && $incidentReport->image_position === 'before')
        <div class="mt-4 mb-4">
            <img src="{{ asset('storage/' . $incidentReport->image_path) }}" alt="{{ $incidentReport->title }}" class="w-full rounded-lg shadow-md max-h-96 object-cover">
        </div>
        @endif

        <p class="mt-4 text-sm/relaxed overflow-auto max-h-60 sm:max-h-80" style="word-wrap: break-word;">
            {!! $incidentReport->narration !!}
        </p>

        <!-- Image After Narration -->
        @if($incidentReport->image_path && $incidentReport->image_position === 'after')
        <div class="mt-4">
            <img src="{{ asset('storage/' . $incidentReport->image_path) }}" alt="{{ $incidentReport->title }}" class="w-full rounded-lg shadow-md max-h-96 object-cover">
        </div>
        @endif
    </div>
</div>
