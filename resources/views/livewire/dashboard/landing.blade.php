<div>
    <div class="grid grid-cols-2 gap-2">
        <div class="grid gap-6 lg:grid-cols-1 lg:gap-8">
             <!-- Display total number of users -->    
             @hasanyrole('superadmin|administrator')
            <div class="flex gap-4">
                <a
                    href="{{ route('user-management') }}"
                    class="flex-1 p-4 bg-white rounded-lg shadow-md dark:bg-zinc-900"
                >
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div>
                                <p class="text-lg font-semibold text-black dark:text-white">Total Users</p>
                                <span class="text-2xl font-extrabold text-[#FF2D20]">{{ $total_users }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endhasanyrole
                @hasanyrole('support')
                <a
                    href="{{ route('complaint') }}"
                    class="flex-1 p-4 bg-white rounded-lg shadow-md dark:bg-zinc-900"
                >
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div>
                                <p class="text-lg font-semibold text-black dark:text-white">Pending Complaints</p>
                                <span class="text-2xl font-extrabold text-[#FF2D20]">{{ $pending_complaints }}</span>
                            </div>
                        </div>
                    </div>
                </a>
                 @endhasanyrole
                <!-- Clickable section for pending clearances -->
                @hasanyrole('superadmin|administrator|support')
                <a
                    href="{{ route('clearance') }}"
                    class="flex-1 p-4 bg-white rounded-lg shadow-md dark:bg-zinc-900"
                >
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div>
                                <p class="text-lg font-semibold text-black dark:text-white">Pending Clearances</p>
                                <span class="text-2xl font-extrabold text-[#FF2D20]">{{ $pending_clearances }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endhasanyrole

            
            
            @forelse($complaints as $complaint)
                <a
                    href="#"
                    class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                >
                    <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                        <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><g fill="#FF2D20"><path d="M24 8.25a.5.5 0 0 0-.5-.5H.5a.5.5 0 0 0-.5.5v12a2.5 2.5 0 0 0 2.5 2.5h19a2.5 2.5 0 0 0 2.5-2.5v-12Zm-7.765 5.868a1.221 1.221 0 0 1 0 2.264l-6.626 2.776A1.153 1.153 0 0 1 8 18.123v-5.746a1.151 1.151 0 0 1 1.609-1.035l6.626 2.776ZM19.564 1.677a.25.25 0 0 0-.177-.427H15.6a.106.106 0 0 0-.072.03l-4.54 4.543a.25.25 0 0 0 .177.427h3.783c.027 0 .054-.01.073-.03l4.543-4.543ZM22.071 1.318a.047.047 0 0 0-.045.013l-4.492 4.492a.249.249 0 0 0 .038.385.25.25 0 0 0 .14.042h5.784a.5.5 0 0 0 .5-.5v-2a2.5 2.5 0 0 0-1.925-2.432ZM13.014 1.677a.25.25 0 0 0-.178-.427H9.101a.106.106 0 0 0-.073.03l-4.54 4.543a.25.25 0 0 0 .177.427H8.4a.106.106 0 0 0 .073-.03l4.54-4.543ZM6.513 1.677a.25.25 0 0 0-.177-.427H2.5A2.5 2.5 0 0 0 0 3.75v2a.5.5 0 0 0 .5.5h1.4a.106.106 0 0 0 .073-.03l4.54-4.543Z"/></g></svg>
                    </div>

                    <div class="pt-3 sm:pt-5">
                        <h2 class="text-xl font-semibold text-black dark:text-white">{{ $complaint->title }}</h2>

                        <p class="mt-4 text-sm/relaxed">
                            {!! $complaint->excerpt() !!}
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
                        <span>No complaint found</span>
                    </div>
                </a>
            @endforelse
        </div>
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
            @endif

            @unlessrole('support')
            @forelse($announcements as $announcement)
            <div>
                <a
                    href="#"
                    wire:click="$dispatch('openModal', { component: 'modals.show.announcement-modal', arguments: { announcement: {{ $announcement }} }})"
                    class="flex items-start gap-4 rounded-lg bg-white p-6 mt-2 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                >
                    <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                        {!! $announcement->category->icon !!}
                    </div>

                    <div class="pt-3 sm:pt-5">
                        <h2 class="text-xl font-semibold text-black dark:text-white">{{ $announcement->title }}</h2>

                        <p class="mt-4 text-sm/relaxed">
                            {!! $announcement->excerpt() !!}
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
            </div>
                @endunlessrole
            @endforelse
        </div>
    </div>
</div>
