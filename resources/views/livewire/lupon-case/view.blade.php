<div x-data="{ openTab: 1 }" class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-10 relative">

    <!-- Close Button -->
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl"
        wire:click="closeModal">
        &times;
    </button>

    <!-- Tab Buttons -->
    <div class="flex border-b mb-4">
        <button :class="openTab === 1 ? 'border-b-2 font-medium text-blue-500' : 'text-gray-500'" @click="openTab = 1"
            class="py-2 px-4 flex-1 text-center">
            Details
        </button>
        <button :class="openTab === 2 ? 'border-b-2 font-medium text-blue-500' : 'text-gray-500'" @click="openTab = 2"
            class="py-2 px-4 flex-1 text-center">
            Summon
        </button>
        <button :class="openTab === 3 ? 'border-b-2 font-medium text-blue-500' : 'text-gray-500'" @click="openTab = 3"
            class="py-2 px-4 flex-1 text-center">
            Hearing
        </button>
    </div>

    <!-- Tab Contents -->
    <div class="mt-4 text-sm text-gray-800 dark:text-gray-300">

        <!-- Details Tab -->
        <div x-show="openTab === 1" x-transition>
            <div>
                <div class="flex justify-between items-center mb-4">
                    <p><span class="font-bold text-xl uppercase">{!! $luponCase->title !!}</span></p>
                    <a href="{{ route('lupon-case.download', $luponCase->id) }}" @click.stop
                        class="relative bg-red-500 text-white p-2 rounded ml-auto flex items-center justify-center group">
                        <i class="fas fa-file-download text-lg"></i>
                        <span
                            class="absolute bottom-full mb-2 hidden group-hover:block bg-gray-700 text-white text-xs px-2 py-1 rounded">
                            Generate Lupon Case PDF
                        </span>
                    </a>
                </div>
                <table style="width: 100%; border-collapse: collapse; table-layout: fixed;">
                    <tbody>
                        @if(!empty($luponCase->blotter_id))
                            <tr class="bg-gray-200">
                                <td class="font-semibold">Blotter ID:</td>
                                <td class="text-sm">{!! $luponCase->blotter_id !!}</td>
                            </tr>
                        @endif
                        <tr>
                            <td class="font-semibold">Date Filed:</td>
                            <td class="text-sm">{{ \Carbon\Carbon::parse($luponCase->date)->format('M j, Y') }}</td>
                        </tr>
                        <tr class="bg-gray-200">
                            <td class="font-semibold">Case #:</td>
                            <td class="text-sm">{!! $luponCase->case_no !!}</td>
                        </tr>
                        <tr>
                            <td class="font-semibold">Status:</td>
                            <td class="text-sm">{!! $luponCase->status !!}</td>
                        </tr>
                        <tr class="bg-gray-200">
                            <td class="font-semibold">Nature Of Case:</td>
                            <td class="text-sm">{!! $luponCase->nature !!}</td>
                        </tr>
                        @if ($luponCase->end)
                            <tr>
                                <td class="font-semibold">Date Closed:</td>
                                <td class="text-sm">{{ \Carbon\Carbon::parse($luponCase->end)->format('M j, Y') }}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                <!-- Complaint and Prayer as Separate Divs -->
                <div class="mt-4 p-4 border rounded ">
                    <p class="font-semibold">Complaint:</p>
                    <p class="text-sm">{!! $luponCase->complaint !!}</p>
                </div>

                <div class="mt-2 p-4 border rounded bg-gray-100">
                    <p class="font-semibold">Prayer:</p>
                    <p class="text-sm">{!! $luponCase->prayer !!}</p>
                </div>


                <div class="mt-4">
                    <!-- Complainants -->
                    @if($luponCase->luponCaseComplainants->isNotEmpty())
                        <details class="bg-white shadow-md rounded-lg p-4 mt-2">
                            <summary class="cursor-pointer font-semibold text-blue-500">Complainants</summary>
                            @foreach($luponCase->luponCaseComplainants as $complainant)
                                <div class="border-t mt-2 pt-2">
                                    <p><strong>Name:</strong> {{ "{$complainant->firstname} " }}
                                        @if($complainant->middlename !== 'N/A')
                                            {{ "{$complainant->middlename} " }}
                                        @endif
                                        {{ "{$complainant->lastname}" }}
                                    </p>
                                    <p><strong>Contact:</strong> {{$complainant->contact_number}}</p>
                                    <p><strong>Address:</strong> {{$complainant->address}}</p>
                                </div>
                            @endforeach
                        </details>
                    @endif
                    @if($luponCase->luponCaseRespondents->isNotEmpty())
                        <details class="bg-white shadow-md rounded-lg p-4 mt-2">
                            <summary class="cursor-pointer font-semibold text-blue-500">Respondents</summary>
                            @foreach($luponCase->luponCaseRespondents as $respondent)
                                <div class="border-t mt-2 pt-2">
                                    <p><strong>Name:</strong>{{ "{$respondent->firstname} " }}
                                        @if($respondent->middlename !== 'N/A')
                                            {{ "{$respondent->middlename} " }}
                                        @endif
                                        {{ "{$respondent->lastname}" }}
                                    </p>
                                    <p><strong>Contact:</strong> {{$respondent->contact_number}}</p>
                                    <p><strong>Address:</strong> {{$respondent->address}}</p>
                                </div>
                            @endforeach
                        </details>
                    @endif

                    @if(!$luponCase->assets->isEmpty())
                        <div class="mt-6">
                            <h3 class="font-semibold">Resolution Form:</h3>
                            <ul class="list-disc list-inside space-y-2">
                                @foreach($luponCase->assets as $resolution_form)
                                    <li class="flex items-center justify-between">
                                        <a href="{{ Storage::url($resolution_form->path) }}" target="_blank"
                                            class="text-blue-500 hover:underline">
                                            {{ basename($resolution_form->path) }}
                                        </a>
                                        <button wire:click="deleteAttachment({{ $resolution_form->id }})"
                                            class="ml-2 px-2 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-700">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <div class="mt-6">
                        <h3 class="font-bold bg-gray-200 p-2">Comments</h3>
                        @if($luponCaseComments && $luponCaseComments->isNotEmpty())
                            <div class="space-y-2">
                                @foreach($luponCase->luponCaseComments as $luponCaseComment)
                                    <div class="border-b py-2">
                                        <span class="font-semibold">{{ $luponCaseComment->user->name }}:</span>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $luponCaseComment->created_at->format('F j, Y') }}
                                        </p>
                                        <p>{{ $luponCaseComment->comment }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p>No comments available.</p>
                        @endif
                    </div>

                    @if(auth()->user()->hasRole('superadmin|administrator|lupon'))
                        <form action="{{ route('luponCaseComments.store', ['luponCase' => $luponCase->id]) }}"
                            method="POST">
                            @csrf
                            <textarea name="luponCaseComment" placeholder="Add a comment..."
                                class="mt-2 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                            <button type="submit" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded">Submit
                                Comment</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <!-- Summon Tab -->
        <div x-show="openTab === 2" x-transition class="min-h-[300px]">
            <div class="flex justify-end gap-2 mb-4">
                <div x-data="{ open: false, summoned_date: '', date_issued: '' }" x-init="
        summoned_date = localStorage.getItem('summoned_date') || '';
        date_issued = localStorage.getItem('date_issued') || '';
    ">
                    <!-- Button to open modal -->
                    <button @click="open = true"
                        class="relative bg-blue-500 text-white p-2 rounded flex items-center justify-center group w-8">
                        <i class="fas fa-file-download text-lg"></i>
                        <span
                            class="absolute bottom-full mb-2 hidden group-hover:block bg-gray-700 text-white text-xs px-2 py-1 rounded">
                            Generate Complainant Summon PDF
                        </span>
                    </button>
                    <!-- Modal -->
                    <div x-show="open" style="background: rgba(0,0,0,0.5);"
                        class="fixed inset-0 flex items-center justify-center z-50">
                        <div class="bg-white p-6 rounded shadow-lg w-96">
                            <h2 class="text-lg font-bold mb-4">Summon PDF Details</h2>
                            <form @submit.prevent="
                    localStorage.setItem('summoned_date', summoned_date);
                    localStorage.setItem('date_issued', date_issued);
                    open = false;
                    setTimeout(() => {
                        window.location.href = '{{ route('complainant-summon.download', $luponCase->id) }}?summoned_date=' + summoned_date + '&date_issued=' + date_issued;
                    }, 200);
                ">
                                @csrf
                                <div class="mb-4">
                                    <label class="block font-semibold mb-1">Summon Date & Time</label>
                                    <input type="datetime-local" x-model="summoned_date" required
                                        class="border px-2 py-1 rounded w-full">
                                </div>
                                <div class="mb-4">
                                    <label class="block font-semibold mb-1">Date Issued</label>
                                    <input type="date" x-model="date_issued" required
                                        class="border px-2 py-1 rounded w-full">
                                </div>
                                <div class="flex justify-end gap-2">
                                    <button type="button" @click="open = false"
                                        class="px-3 py-1 rounded bg-gray-300">Cancel</button>
                                    <button type="submit" class="px-3 py-1 rounded bg-blue-600 text-white">Generate
                                        PDF</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div x-data="{ open: false, summoned_date: '', date_issued: '' }" x-init="
        summoned_date = localStorage.getItem('summoned_date') || '';
        date_issued = localStorage.getItem('date_issued') || '';
    ">
                    <!-- Button to open modal -->
                    <button @click="open = true"
                        class="relative bg-red-500 text-white p-2 rounded flex items-center justify-center group w-8">
                        <i class="fas fa-file-download text-lg"></i>
                        <span
                            class="absolute bottom-full mb-2 hidden group-hover:block bg-gray-700 text-white text-xs px-2 py-1 rounded">
                            Generate Respondent Summon PDF
                        </span>
                    </button>
                    <!-- Modal -->
                    <div x-show="open" style="background: rgba(0,0,0,0.5);"
                        class="fixed inset-0 flex items-center justify-center z-50">
                        <div class="bg-white p-6 rounded shadow-lg w-96">
                            <h2 class="text-lg font-bold mb-4">Summon PDF Details</h2>
                            <form @submit.prevent="
                    localStorage.setItem('summoned_date', summoned_date);
                    localStorage.setItem('date_issued', date_issued);
                    open = false;
                    setTimeout(() => {
                        window.location.href = '{{ route('lupon-summon.download', $luponCase->id) }}?summoned_date=' + summoned_date + '&date_issued=' + date_issued;
                    }, 200);
                ">
                                @csrf
                                <div class="mb-4">
                                    <label class="block font-semibold mb-1">Summon Date & Time</label>
                                    <input type="datetime-local" x-model="summoned_date" required
                                        class="border px-2 py-1 rounded w-full">
                                </div>
                                <div class="mb-4">
                                    <label class="block font-semibold mb-1">Date Issued</label>
                                    <input type="date" x-model="date_issued" required
                                        class="border px-2 py-1 rounded w-full">
                                </div>
                                <div class="flex justify-end gap-2">
                                    <button type="button" @click="open = false"
                                        class="px-3 py-1 rounded bg-gray-300">Cancel</button>
                                    <button type="submit" class="px-3 py-1 rounded bg-blue-600 text-white">Generate
                                        PDF</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if($luponSummonTrackings && $luponSummonTrackings->isNotEmpty())


                @foreach($luponSummonTrackings as $summonTracking)
                    <div class="mb-5">

                        <table width="100%" class="mt-4">
                            <tbody>
                                <tr class="bg-gray-200">
                                    <td class="font-semibold">Date and Time:</td>
                                    <td class="text-sm">
                                        {{ \Carbon\Carbon::parse($summonTracking->date_time)->format('M j, Y g:i A') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-semibold">Received By:</td>
                                    <td class="text-sm">{{ $summonTracking->received_by }}</td>
                                </tr>
                                <tr class="bg-gray-200">
                                    <td class="font-semibold">Served By:</td>
                                    <td class="text-sm">{{ $summonTracking->served_by }}</td>
                                </tr>
                                <tr>
                                    <td class="font-semibold">Remarks:</td>
                                    <td class="text-sm">{{ $summonTracking->remarks }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <x-secondary-button
                        wire:click.stop="$dispatch('openModal', { component: 'modals.luponSummonTracking-modal', arguments: { luponSummonTracking: {{ $summonTracking->id }} }})">
                        <i class="fas fa-pencil-alt"></i>
                    </x-secondary-button>
                    <x-danger-button
                        @click="if (confirm('Are you sure you want to delete this?')) { $wire.call('deleteSummon', {{ $summonTracking->id }}) }"
                        wire:click.stop>
                        <i class="fas fa-trash-alt"></i>
                    </x-danger-button>
                    <hr class="my-4 border-t-2 border-gray-300 dark:border-gray-700">
                @endforeach
            @endif
        </div>
    </div>

    <!-- Hearing Tab -->
    <div x-show="openTab === 3" x-transition class="min-h-[300px]">
        @if($luponHearingTrackings && $luponHearingTrackings->isNotEmpty())
            @foreach($luponHearingTrackings as $hearingTracking)
                <div class="mb-10">
                    <table width="100%" class="mt-4">
                        <tbody>
                            <tr class="bg-gray-200">
                                <td class="font-semibold">Date and Time:</td>
                                <td class="text-sm">
                                    {{ \Carbon\Carbon::parse($hearingTracking->date_time)->format('M j, Y g:i A') }}
                                </td>
                            </tr>
                            <tr>
                                <td class="font-semibold">Type:</td>
                                <td class="text-sm">{{ ucfirst($hearingTracking->type) }}</td>
                            </tr>
                            <tr class="bg-gray-200">
                                <td class="font-semibold">Secretary:</td>
                                <td class="text-sm">{{ $hearingTracking->secretary }}</td>
                            </tr>
                            <tr>
                                <td class="font-semibold">Presider:</td>
                                <td class="text-sm">{{ $hearingTracking->presider }}</td>
                            </tr>
                            <tr class="bg-gray-200">
                                <td class="font-semibold">Remarks:</td>
                                <td class="text-sm">{{ $hearingTracking->remarks }}</td>
                            </tr>
                        </tbody>
                    </table>

                    @if(!$hearingTracking->assets->isEmpty())
                        <div class="mt-4">
                            <h3 class="font-semibold">Images:</h3>
                            <ul class="list-disc list-inside space-y-2">
                                @foreach($hearingTracking->assets as $attachements)
                                    <li>
                                        <a href="{{ Storage::url($attachements->path) }}" target="_blank"
                                            class="text-blue-500 hover:underline">
                                            {{ basename($attachements->path) }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                <x-secondary-button
                    wire:click.stop="$dispatch('openModal', { component: 'modals.luponHearingTracking-modal', arguments: { luponHearingTracking: {{ $hearingTracking->id }} }})">
                    <i class="fas fa-pencil-alt"></i>
                </x-secondary-button>
                <x-danger-button
                    @click="if (confirm('Are you sure you want to delete this?')) { $wire.call('deleteHearing', {{ $hearingTracking->id }}) }"
                    wire:click.stop>
                    <i class="fas fa-trash-alt"></i>
                </x-danger-button>
                <hr class="my-4 border-t-2 border-gray-300 dark:border-gray-700">


            @endforeach
        @endif
    </div>

</div>
</div>