<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 relative">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" 
            wire:click="closeModal">
        &times;
    </button>

    <div x-data="{ openTab: 1 }">
            <!-- Conditionally Render Tab Buttons -->
            <div class="flex border-b">
                <button 
                    :class="openTab === 1 ? 'border-b-2 font-medium text-blue-500' : 'text-gray-500'" 
                    @click="openTab = 1" 
                    class="py-2 px-4 flex-1 text-center">
                    Details
                </button>
                <button 
                    :class="openTab === 2 ? 'border-b-2 font-medium text-blue-500' : 'text-gray-500'" 
                    @click="openTab = 2" 
                    class="py-2 px-4 flex-1 text-center">
                    Summon
                </button>
                <button 
                    :class="openTab === 3 ? 'border-b-2 font-medium text-blue-500' : 'text-gray-500'" 
                    @click="openTab = 3" 
                    class="py-2 px-4 flex-1 text-center">
                    Hearing
                </button>
            </div>


    <div x-show="openTab === 1" class="mt-4 text-sm text-gray-800 dark:text-gray-300">
        <p><span class="font-bold uppercase">{{ \Carbon\Carbon::parse($luponCase->date)->format('M j, Y') }}</span></p>

        <table width="100%" class="mt-4">
            <tbody>
                <tr class="bg-gray-200">
                    <td class="font-semibold">Case #:</td>
                    <td class="text-sm">{!! $luponCase->case_no !!}</td>
                </tr>
                <tr>
                    <td class="font-semibold">Complaint:</td>
                    <td class="text-sm">{!! $luponCase->complaint !!}</td>
                </tr>
                <tr class="bg-gray-200">
                    <td class="font-semibold">Prayer:</td>
                    <td class="text-sm">{!! $luponCase->prayer !!}</td>
                </tr>
            </tbody>
        </table>

        @if($luponCase->blotter_id)
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-black dark:text-white">Complainant</h3>
                <table width="100%">
                    <tbody>
                        <tr class="bg-gray-200">
                            <td class="font-semibold">Full Name:</td>
                            <td class="text-sm">
                                {{ trim("{$luponCase->blotter->firstname} {$luponCase->blotter->middle} {$luponCase->blotter->lastname}") }}
                            </td>
                        </tr>
                        <tr>
                            <td class="font-semibold">Contact:</td>
                            <td class="text-sm">{{ $luponCase->blotter->contact }}</td>
                        </tr>
                        <tr class="bg-gray-200">
                            <td class="font-semibold">Address:</td>
                            <td class="text-sm">{{ $luponCase->blotter->address }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            @if($luponCase->blotter->complainee_id)
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-black dark:text-white">Respondent</h3>
                    <table width="100%">
                        <tbody>
                            <tr class="bg-gray-200">
                                <td class="font-semibold">Full Name:</td>
                                <td class="text-sm">
                                    {{ trim("{$luponCase->blotter->complainee->firstname} {$luponCase->blotter->complainee->middle} {$luponCase->blotter->complainee->lastname}") }}
                                </td>
                            </tr>
                            <tr>
                                <td class="font-semibold">Contact:</td>
                                <td class="text-sm">{{ $luponCase->blotter->complainee->contact }}</td>
                            </tr>
                            <tr class="bg-gray-200">
                                <td class="font-semibold">Address:</td>
                                <td class="text-sm">{{ $luponCase->blotter->complainee->address }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endif
        @else
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-black dark:text-white">Complainant</h3>
                @foreach($luponCase->luponCaseComplainants as $complainant)
                <div class="mb-10">
                    <table width="100%">
                        <tbody>
                            
                                <tr class="bg-gray-200">
                                    <td style="font-size: 14px; white-space: nowrap"><span class="font-semibold">Full Name:</td>
                                    <td class="text-sm">
                                        {{ trim("{$complainant->firstname} {$complainant->middlename} {$complainant->lastname}") }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-semibold">Contact:</td>
                                    <td class="text-sm">{{ $complainant->contact_number }}</td>
                                </tr>
                                <tr class="bg-gray-200">
                                    <td class="font-semibold">Address:</td>
                                    <td class="text-sm">{{ $complainant->address }}</td>
                                </tr>
                            
                        </tbody>
                    </table>
                    <hr class="my-4 border-t-2 border-gray-300 dark:border-gray-700">
                    @endforeach
                </div>  
            </div>

            <div class="mt-6">
                <h3 class="text-lg font-semibold text-black dark:text-white">Respondent</h3>
                @foreach($luponCase->luponCaseRespondents as $respondent)
                <div class="mb-10">
                <table width="100%">
                    <tbody>
                        
                            <tr class="bg-gray-200">
                                <td style="font-size: 14px; white-space: nowrap"><span class="font-semibold">Full Name:</td>
                                <td class="text-sm">
                                    {{ trim("{$respondent->firstname} {$respondent->middlename} {$respondent->lastname}") }}
                                </td>
                            </tr>
                            <tr>
                                <td class="font-semibold">Contact:</td>
                                <td class="text-sm">{{ $respondent->contact_number }}</td>
                            </tr>
                            <tr class="bg-gray-200">
                                <td class="font-semibold">Address:</td>
                                <td class="text-sm">{{ $respondent->address }}</td>
                            </tr>
                    </tbody>
                </table>
                <hr class="my-4 border-t-2 border-gray-300 dark:border-gray-700">
                @endforeach
                </div>
                
            </div>
        @endif

        @if(!$luponCase->assets->isEmpty())
            <div class="mt-6">
                <h3 class="font-semibold">Resolution Form:</h3>
                <ul class="list-disc list-inside space-y-2">
                    @foreach($luponCase->assets as $resolution_form)
                        <li>
                            <a href="{{ Storage::url($resolution_form->path) }}" 
                               target="_blank" 
                               class="text-blue-500 hover:underline">
                                {{ basename($resolution_form->path) }}
                            </a>
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
            <form action="{{ route('luponCaseComments.store', ['luponCase' => $luponCase->id]) }}" method="POST">
                @csrf
                <textarea name="luponCaseComment" placeholder="Add a comment..." 
                          class="mt-2 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                <x-primary-button type="submit" class="mt-2">Submit Comment</x-primary-button>
            </form>
        @endif
    </div>

    <div x-show="openTab === 3" class="tab-content mt-4 text-sm text-gray-800 dark:text-gray-300">
           
    @if($luponHearingTrackings && $luponHearingTrackings->isNotEmpty())
                @foreach($luponHearingTrackings as $hearingTracking)
                <div class="mb-10">
                <table width="100%" class="mt-4">
                        <tbody>
                                <tr class="bg-gray-200">
                                    <td class="font-semibold">Date and Time:</td>
                                    <td class="text-sm"> {{ \Carbon\Carbon::parse($hearingTracking->date_time)->format('M j, Y g:i A') }}</td>
                                </tr>
                                <tr>
                                    <td class="font-semibold">Type:</td>
                                    <td class="text-sm">{{ ucfirst($hearingTracking->type) }}</td>
                                </tr>
                                <tr class="bg-gray-200">
                                    <td class="font-semibold">Remarks:</td>
                                    <td class="text-sm">{{ $hearingTracking->remarks }}</td>
                                </tr>
                        
                        </tbody>
                    </table>
                    <hr class="my-4 border-t-2 border-gray-300 dark:border-gray-700">
                    @endforeach
                @else
                    <p>No Hearing Details Available.</p>
                @endif
                </div>
        </div>

    <div x-show="openTab === 2" class="tab-content mt-4 text-sm text-gray-800 dark:text-gray-300">
            @if($luponSummonTrackings && $luponSummonTrackings->isNotEmpty())
                    @foreach($luponSummonTrackings as $summonTracking)
                    <div class="mb-10">
                    <table width="100%" class="mt-4">
                            <tbody>
                                    <tr class="bg-gray-200">
                                        <td class="font-semibold">Date and Time:</td>
                                        <td class="text-sm">{{ \Carbon\Carbon::parse($summonTracking->date_time)->format('M j, Y g:i A') }}</td>
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
                        <hr class="my-4 border-t-2 border-gray-300 dark:border-gray-700">
                        @endforeach
                    @else
                        <p>No Summon Details Available.</p>
                    @endif
                    </div>
            </div>
    </div>
</div>