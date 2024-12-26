<div>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
        <div class="grid gap-6">

        @unlessrole('user|anonymous')
        @if($todos->isNotEmpty())
                <div>
                    <h2 class="text-lg font-semibold text-black dark:text-white">Pending Tasks</h2>
                    @foreach($todos as $todo)
                        <div class="mt-4">
                            <a href="{{ route('todo') }}" class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-md ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] dark:bg-zinc-900 dark:ring-zinc-800">
                                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10">
                                    <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#FF2D20">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2v6h6" />
                                    </svg>
                                </div>
                                <div class="pt-3">
                                    <h2 class="text-xl font-semibold text-black dark:text-white">{{ $todo->task }}</h2>
                                    @if($todo->due_date)
                                        <p class="mt-4 text-sm/relaxed">Due Date: {{ $todo->due_date->format('F j, Y') }}</p>
                                    @endif
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        @endunlessrole

        @hasanyrole('support|superadmin|administrator')
                <a href="{{ route('complaint') }}" class="flex-1 p-4 bg-white rounded-lg shadow-md dark:bg-zinc-900">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div>
                                <p class="text-lg font-semibold text-black dark:text-white">Pending Complaints</p>
                                <span class="text-2xl font-extrabold text-[#FF2D20]">{{ $pending_complaints }}</span>
                            </div>
                        </div>
                    </div>
                </a>

            <!-- Clickable section for pending clearances -->
                <a href="{{ route('clearance') }}" class="flex-1 p-4 bg-white rounded-lg shadow-md dark:bg-zinc-900">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div>
                                <p class="text-lg font-semibold text-black dark:text-white">Pending Clearances</p>
                                <span class="text-2xl font-extrabold text-[#FF2D20]">{{ $pending_clearances }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            @endhasanyrole
            <!-- Display total number of users -->
            @hasanyrole('superadmin|administrator')
            <div x-data="{ open: false }" class="my-4">
                <!-- Collapsible Header -->
                <div @click="open = !open" class="flex items-center justify-between p-4 bg-white rounded-lg shadow-md dark:bg-zinc-900 cursor-pointer lg:hidden">
                    <p class="text-lg font-semibold text-black dark:text-white">User Statistics</p>
                    <span class="ml-2 transform transition-transform" :class="{ 'rotate-180': open }">
                        &#9660; <!-- Down arrow -->
                    </span>
                </div>

                <!-- Collapsible Content for Mobile -->
                <div x-show="open" class="grid grid-cols-1 lg:grid-cols-3 gap-4 p-4 bg-gray-50 dark:bg-zinc-800 lg:hidden">
                    <!-- Out of School Youth -->
                    <a href="{{ route('settings') }}" class="relative p-4 bg-cover bg-center rounded-lg shadow-md dark:bg-zinc-900" style="background-image: url('/storage/OutofSchool.png');">
                        <div class="absolute inset-0 bg-white opacity-80 rounded-lg"></div>
                        <div class="relative z-5"> 
                            <div>
                                <p class="text-lg font-semibold text-black">Out of School Youth</p>
                                <span class="text-2xl font-extrabold text-[#FF2D20]">{{ $total_out_of_school_youth['total'] }}</span>
                            </div>
                        </div>
                    </a>

                    <!-- Malnourished Children -->
                    <a href="{{ route('settings') }}" class="relative p-4 bg-cover bg-center rounded-lg shadow-md dark:bg-zinc-900" style="background-image: url('/storage/malnourished.png');">
                        <div class="absolute inset-0 bg-white opacity-80 rounded-lg"></div>
                        <div class="relative z-5">
                            <p class="text-lg font-semibold text-black dark:text-white">Malnourished Children</p>
                            <span class="text-2xl font-extrabold text-[#FF2D20]">{{ $total_malnourished_children['total'] }}</span>
                        </div>
                    </a>

                    <!-- Senior Citizen -->
                    <a href="{{ route('settings') }}" class="relative p-4 bg-cover bg-center rounded-lg shadow-md dark:bg-zinc-900" style="background-image: url('/storage/senior.png');">
                        <div class="absolute inset-0 bg-white opacity-80 rounded-lg"></div>
                        <div class="relative z-7">
                            <p class="text-lg font-semibold text-black dark:text-white">Senior Citizen</p>
                            <span class="text-2xl font-extrabold text-[#FF2D20]">{{ $total_senior_citizens['total'] }}</span>
                        </div>
                    </a>

                    <!-- Pregnant -->
                    <a href="{{ route('settings') }}" class="relative p-4 bg-cover bg-center rounded-lg shadow-md dark:bg-zinc-900" style="background-image: url('/storage/Pregnant.png');">
                        <div class="absolute inset-0 bg-white opacity-80 rounded-lg"></div>
                        <div class="relative z-5">
                            <p class="text-lg font-semibold text-black dark:text-white">Pregnant</p>
                            <span class="text-2xl font-extrabold text-[#FF2D20]">{{ $total_pregnant['total'] }}</span>
                        </div>
                    </a>

                    <!-- Single Parent -->
                    <a href="{{ route('settings') }}" class="relative p-4 bg-cover bg-center rounded-lg shadow-md dark:bg-zinc-900" style="background-image: url('/storage/singleparent.png');">
                        <div class="absolute inset-0 bg-white opacity-80 rounded-lg"></div>
                        <div class="relative z-5">
                            <p class="text-lg font-semibold text-black dark:text-white">Single Parent</p>
                            <span class="text-2xl font-extrabold text-[#FF2D20]">{{ $total_single_parents['total'] }}</span>
                        </div>
                    </a>
                </div>

                <!-- Desktop View -->
                <div class="hidden lg:grid lg:grid-cols-3 lg:gap-4 lg:p-4 lg:bg-gray-50 lg:dark:bg-zinc-800">
                    <!-- Out of School Youth -->
                    <a href="{{ route('settings') }}" class="relative p-4 bg-cover bg-center rounded-lg shadow-md dark:bg-zinc-900" style="background-image: url('/storage/OutofSchool.png');">
                        <div class="absolute inset-0 bg-white opacity-80 rounded-lg"></div>
                        <div class="relative z-5">
                            <p class="text-lg font-semibold text-black dark:text-white">Out of School Youth</p>
                            <span class="text-2xl font-extrabold text-[#FF2D20]">{{ $total_out_of_school_youth['total'] }}</span>
                        </div>
                    </a>

                    <!-- Malnourished Children -->
                    <a href="{{ route('settings') }}" class="relative p-4 bg-cover bg-center rounded-lg shadow-md dark:bg-zinc-900" style="background-image: url('/storage/malnourished.png');">
                        <div class="absolute inset-0 bg-white opacity-80 rounded-lg"></div>
                        <div class="relative z-5">
                            <p class="text-lg font-semibold text-black dark:text-white">Malnourished Children</p>
                            <span class="text-2xl font-extrabold text-[#FF2D20]">{{ $total_malnourished_children['total'] }}</span>
                        </div>
                    </a>

                    <!-- Senior Citizen -->
                    <a href="{{ route('settings') }}" class="relative p-4 bg-cover bg-center rounded-lg shadow-md dark:bg-zinc-900" style="background-image: url('/storage/senior.png');">
                        <div class="absolute inset-0 bg-white opacity-80 rounded-lg"></div>
                        <div class="relative z-5">
                            <p class="text-lg font-semibold text-black dark:text-white">Senior Citizens</p>
                            <span class="text-2xl font-extrabold text-[#FF2D20]">{{ $total_senior_citizens['total'] }}</span>
                        </div>
                    </a>

                    <!-- Pregnant -->
                    <a href="{{ route('settings') }}" class="relative p-4 bg-cover bg-center rounded-lg shadow-md dark:bg-zinc-900" style="background-image: url('/storage/Pregnant.png');">
                        <div class="absolute inset-0 bg-white opacity-80 rounded-lg"></div>
                        <div class="relative z-5">
                            <p class="text-lg font-semibold text-black dark:text-white">Pregnants</p>
                            <span class="text-2xl font-extrabold text-[#FF2D20]">{{ $total_pregnant['total'] }}</span>
                        </div>
                    </a>

                    <!-- Single Parent -->
                    <a href="{{ route('settings') }}" class="relative p-4 bg-cover bg-center rounded-lg shadow-md dark:bg-zinc-900" style="background-image: url('/storage/singleparent.png');">
                        <div class="absolute inset-0 bg-white opacity-80 rounded-lg"></div>
                        <div class="relative z-8">
                            <p class="text-lg font-semibold text-black dark:text-white">Single Parents</p>
                            <span class="text-2xl font-extrabold text-[#FF2D20]">{{ $total_single_parents['total'] }}</span>
                        </div>
                    </a>
                </div>
            </div>
            @endhasanyrole


            @hasanyrole('user')
                @forelse($complaints as $complaint)
                    <a href="#" class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-md ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] dark:bg-zinc-900 dark:ring-zinc-800">
                        <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10">
                            <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <g fill="#FF2D20">
                                    <path d="M24 8.25a.5.5 0 0 0-.5-.5H.5a.5.5 0 0 0-.5.5v12a2.5 2.5 0 0 0 2.5 2.5h19a2.5 2.5 0 0 0 2.5-2.5v-12Zm-7.765 5.868a1.221 1.221 0 0 1 0 2.264l-6.626 2.776A1.153 1.153 0 0 1 8 18.123v-5.746a1.151 1.151 0 0 1 1.609-1.035l6.626 2.776ZM19.564 1.677a.25.25 0 0 0-.177-.427H15.6a.106.106 0 0 0-.072.03l-4.54 4.543a.25.25 0 0 0 .177.427h3.783c.027 0 .054-.01.073-.03l4.543-4.543ZM22.071 1.318a.047.047 0 0 0-.045.013l-4.492 4.492a.249.249 0 0 0 .038.385.25.25 0 0 0 .14.042h5.784a.5.5 0 0 0 .5-.5v-2a2.5 2.5 0 0 0-1.925-2.432ZM13.014 1.677a.25.25 0 0 0-.178-.427H9.101a.106.106 0 0 0-.073.03l-4.54 4.543a.25.25 0 0 0 .177.427H8.4a.106.106 0 0 0 .073-.03l4.54-4.543ZM6.513 1.677a.25.25 0 0 0-.177-.427H2.5A2.5 2.5 0 0 0 0 3.75v2a.5.5 0 0 0 .5.5h1.4a.106.106 0 0 0 .073-.03l4.54-4.543Z"/>
                                </g>
                            </svg>
                        </div>

                        <div class="pt-3">
                            <h2 class="text-xl font-semibold text-black dark:text-white">{{ $complaint->title }}</h2>
                            <p class="mt-4 text-sm/relaxed">{!! $complaint->excerpt() !!}</p>
                        </div>

                        <svg class="size-6 shrink-0 self-center stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/>
                        </svg>
                    </a>
                @empty
                    <div class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-md ring-1 ring-white/[0.05] dark:bg-zinc-900 dark:ring-zinc-800">
                        <div class="pt-3">
                            <span>No complaint found</span>
                        </div>
                    </div>
                @endforelse
            @endhasanyrole
        </div>

        <div class="grid gap-6">
            @if($pinned_announcement)
                <a href="#" wire:click="$dispatch('openModal', { component: 'modals.show.announcement-modal', arguments: { announcement: {{ $pinned_announcement }} }})" class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow-md ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] dark:bg-zinc-900 dark:ring-zinc-800">
                    <div class="flex items-center gap-6 lg:items-end">
                        <div id="docs-card-content" class="flex items-start gap-6">
                            <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10">
                                {!! $pinned_announcement->category->icon !!}
                            </div>

                            <div class="pt-3">
                                <h2 class="text-xl font-semibold text-black dark:text-white">{{ $pinned_announcement->title }}</h2>
                                <span class="block text-gray-500 dark:text-gray-400" style="font-size: 0.65rem;">
                                     {{ $pinned_announcement->created_at->format('F j, Y') }}
                                </span>
                                <div class="mt-4 text-sm/relaxed">{!! $pinned_announcement->excerpt(500) !!}</div>
                            </div>
                        </div>

                        <svg class="size-6 shrink-0 stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/>
                        </svg>
                    </div>
                </a>
            @endif

                @forelse($announcements as $announcement)
                    <a href="#" wire:click="$dispatch('openModal', { component: 'modals.show.announcement-modal', arguments: { announcement: {{ $announcement }} }})" class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-md ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] dark:bg-zinc-900 dark:ring-zinc-800">
                        <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10">
                            {!! $announcement->category->icon !!}
                        </div>

                        <div class="pt-3">
                            <h2 class="text-xl font-semibold text-black dark:text-white">{{ $announcement->title }}</h2>
                            <span class="block text-gray-500 dark:text-gray-400" style="font-size: 0.65rem;">
                                     {{ $announcement->created_at->format('F j, Y') }}
                             </span>
                            <p class="mt-4 text-sm/relaxed">{!! $announcement->excerpt() !!}</p>
                        </div>

                        <svg class="size-6 shrink-0 self-center stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/>
                        </svg>
                    </a>
                @empty
                    <div class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-md ring-1 ring-white/[0.05] dark:bg-zinc-900 dark:ring-zinc-800">
                        <div class="pt-3">
                            <span>No announcement found</span>
                        </div>
                    </div>
                @endforelse
        </div>
        
        @unlessrole('user|anonymous')
        @if($activities->isNotEmpty())
            <div>
                <h2 class="text-lg font-semibold text-black dark:text-white">Today's Activities</h2>
                @foreach($activities as $activity)
                    <div class="mt-4">
                        <a href="#" class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-md ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] dark:bg-zinc-900 dark:ring-zinc-800">
                            <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10">
                                <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#FF2D20">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M3 9h18M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="pt-3">
                                <h2 class="text-xl font-semibold text-black dark:text-white">{{ $activity->title }}</h2>
                                <p class="mt-4 text-sm/relaxed">{{ $activity->description }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
        @endunlessrole

       

    </div>
</div>
