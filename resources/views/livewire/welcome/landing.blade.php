<div>
    <!-- Photo Banner Section -->
    @if($latest_photo && $latest_photo->path)
    <div id="photo-container" class="w-full flex items-center justify-center bg-black bg-opacity-50">
    <img id="latest-photo" src="{{ asset('storage/public/' . $latest_photo->path) }}" alt="Latest Photo" class="object-cover w-full" />
    </div>

    @else
        <div class="h-40 bg-gray-300 flex items-center justify-center">
            <span class="text-gray-700">No photo available</span>
        </div>
    @endif
    <div class="grid grid-cols-2 gap-2 mt-5">
        <div class="grid gap-6 lg:grid-cols-1 lg:gap-8">
            @if($pinned_announcement)
                <a
                    href="#"
                    wire:click="$dispatch('openModal', { component: 'modals.show.announcement-modal', arguments: { announcement: {{ $pinned_announcement }} }})"
                    class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                >
                    <div class="relative flex items-center gap-6 lg:items-end">
                        <div id="docs-card-content" class="flex items-start gap-6 lg:flex-col">
                            <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                                {!! $pinned_announcement->category->icon !!}
                            </div>

                            <div class="pt-3 sm:pt-5 lg:pt-0">
                                <h2 class="text-xl font-semibold text-black dark:text-white">{{ $pinned_announcement->title }}</h2>

                                <div class="mt-4 text-sm/relaxed">
                                    {!! $pinned_announcement->excerpt(500) !!}
                                </div>
                            </div>
                        </div>
                        <svg class="size-6 shrink-0 stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg>
                    </div>
                </a>
            @else
                <a
                    href="#"
                    class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] md:row-span-3 lg:p-10 lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                >
                    <div class="relative flex items-center gap-6 lg:items-end">
                        <div id="docs-card-content" class="flex items-start gap-6 lg:flex-col">
                            <div class="pt-3 sm:pt-5 lg:pt-0">
                                <h2 class="text-xl font-semibold text-black dark:text-white"></h2>

                                <div class="pt-3 sm:pt-5">
                                    <span>No pinned announcement found</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @endif
        </div>

        <div class="grid gap-6 lg:grid-cols-1 lg:gap-8">
            @forelse($announcements as $announcement)
                <a
                    href="#"
                    wire:click="$dispatch('openModal', { component: 'modals.show.announcement-modal', arguments: { announcement: {{ $announcement }} }})"
                    class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                >
                    <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                        {!! $announcement->category->icon !!}
                    </div>

                    <div class="pt-3 sm:pt-5">
                        <h2 class="text-xl font-semibold text-black dark:text-white">{{ $announcement->title }}</h2>

                        <p class="mt-4 text-sm/relaxed">
                            {!! $announcement->excerpt(100) !!}
                        </p>
                    </div>

                    <svg class="size-6 shrink-0 self-center stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg>
                </a>
            @empty
                <a
                    href="#"
                    class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                >
                    <div class="pt-3 sm:pt-5">
                        <span>No announcement found</span>
                    </div>
                </a>
            @endforelse
        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const img = document.getElementById("latest-photo");
    const container = document.getElementById("photo-container");

    img.onload = function() {
        // Get the actual height of the image
        const imgHeight = img.naturalHeight;

        // Set the container's height to the image height (in pixels)
        container.style.height = imgHeight + 'px';
    };
});
</script>