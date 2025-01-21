<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    <div>
        <div class="mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">
            <p>
                <span class="font-bold uppercase">{!! $luponCase->date !!}</span>
            </p>
            <table width="100%">
                <tbody>
                    <tr style="background: #eeeeee">
                        <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Case #:</td>
                        <td style="font-size: 14px;">{!! $luponCase->case_no !!}</td>
                    </tr>
                    <tr >
                        <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Complaint:</td>
                        <td style="font-size: 14px;">{!! $luponCase->complaint !!}</td>
                    </tr>
                    <tr style="background: #eeeeee">
                        <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Prayer:</td>
                        <td style="font-size: 14px;">{!! $luponCase->prayer !!}</td>
                    </tr>

                </tbody>
            </table>
            
            @if($luponCase->blotter_id)
            <div>
                <h3 class="text-lg font-semibold text-black dark:text-white mt-3">Complainant</h3>
                <table  width="100%">
                <tbody>   
                        <tr style="background: #eeeeee">
                            <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300"><span class="font-semibold">Full Name:</span></td>
                            <td style="font-size: 14px;">{{ trim("{$luponCase->blotter->firstname} {$luponCase->blotter->middle} {$luponCase->blotter->lastname}") }}</td>
                        </tr>
                        <tr>
                            <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300"><span class="font-semibold">Contact:</span></td>
                            <td style="font-size: 14px;">{{$luponCase->blotter->contact}}</td>
                        </tr>
                        <tr style="background: #eeeeee">
                            <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300"><span class="font-semibold">Address:</span></td>
                            <td style="font-size: 14px;">{{$luponCase->blotter->address}}</td>
                        </tr>
                        </tbody>
                </table>
            </div>

            @if($luponCase->blotter->complainee_id)
            <div>
                <h3 class="text-lg font-semibold text-black dark:text-white mt-3">Respondent</h3>
                <table  width="100%">
                <tbody>   
                        <tr style="background: #eeeeee">
                            <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300"><span class="font-semibold">Full Name:</span></td>
                            <td style="font-size: 14px;">{{ trim("{$luponCase->blotter->complainee->firstname} {$luponCase->blotter->complainee->middle} {$luponCase->blotter->complainee->lastname}") }}</td>
                        </tr>
                        <tr>
                            <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300"><span class="font-semibold">Contact:</span></td>
                            <td style="font-size: 14px;">{{$luponCase->blotter->complainee->contact}}</td>
                        </tr>
                        <tr style="background: #eeeeee">
                            <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300"><span class="font-semibold">Address:</span></td>
                            <td style="font-size: 14px;">{{$luponCase->blotter->complainee->address}}</td>
                        </tr>
                        </tbody>
                </table>
            </div>
            @endif
            @else
            <div>
                <h3 class="text-lg font-semibold text-black dark:text-white mt-3">Complainant</h3>
                <table  width="100%">
                <tbody>   
                @foreach($luponCase->luponCaseComplainants as $complainant)
                        <tr style="background: #eeeeee">
                            <td style="font-size: 14px; white-space: nowrap"><span class="font-semibold">Full Name:</span></td>
                            <td style="font-size: 14px;">{{ trim("{$complainant->firstname} {$complainant->middlename} {$complainant->lastname}") }}</td>
                        </tr>
                        <tr>
                            <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300"><span class="font-semibold">Contact:</span></td>
                            <td style="font-size: 14px;">{{$complainant->contact_number}}</td>
                        </tr>
                        <tr style="background: #eeeeee">
                            <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300"><span class="font-semibold">Address:</span></td>
                            <td style="font-size: 14px;">{{$complainant->address}}</td>
                        </tr>
                     </tbody>
                        @endforeach
                </table>
            </div>
            
            <div>
                <h3 class="text-lg font-semibold text-black dark:text-white mt-3">Respondent</h3>
                <table  width="100%">
                <tbody>  
                @foreach($luponCase->luponCaseRespondents as $respondent) 
                        <tr style="background: #eeeeee">
                            <td style="font-size: 14px; white-space: nowrap"><span class="font-semibold">Full Name:</span></td>
                            <td style="font-size: 14px;">{{ trim("{$respondent->firstname} {$respondent->middlename} {$respondent->lastname}") }}</td>
                        </tr>
                        <tr>
                            <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300"><span class="font-semibold">Contact:</span></td>
                            <td style="font-size: 14px;">{{$respondent->contact_number}}</td>
                        </tr>
                        <tr style="background: #eeeeee">
                            <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300"><span class="font-semibold">Address:</span></td>
                            <td style="font-size: 14px;">{{$respondent->address}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
            
            @if(!$luponCase->assets->isEmpty())
            <h3 class="font-semibold">Resolution Form:</h3>
            <ul class="list-disc list-inside space-y-2">
                @foreach($luponCase->assets as $resolution_form)
                    <li>
                        <a href="{{ Storage::url($resolution_form->path) }}" target="_blank" class="text-blue-500 hover:underline">
                            {{ basename($resolution_form->path) }}
                        </a>
                    </li>
                @endforeach
            </ul>
            @endif
        </div>
        <div class="mt-4 text-sm/relaxed text-gray-800 dark:text-gray-300 space-y-2">
        <h3 class="font-bold" style="background: #eeeeee; padding: 5px;">Comments</h3>
        @if($luponCaseComments && $luponCaseComments->isNotEmpty())
            <div class="text-sm/relaxed text-gray-800 dark:text-gray-300 space-y-2">
                @foreach($luponCase->luponCaseComments as $luponCaseComment)
                    <div class="border-b py-2">
                        <span class='font-semibold'>{{ $luponCaseComment->user->name }}:</span>
                        <p class="block text-gray-500 dark:text-gray-400" style="font-size: 0.65rem;">
                            {{ $luponCaseComment->created_at->format('F j, Y') }}
                        </p>
                        <p>{{ $luponCaseComment->comment }}</p>
                    </div>
                @endforeach
                    @else
                        <p>No comments available.</p>
                    @endif
            </div>

            @if(auth()->user()->hasRole('superadmin|administrator|lupon'))
                <form action="{{ route('luponCaseComments.store', ['luponCase' => $luponCase->id]) }}" method="POST">
                    @csrf
                    <textarea name="luponCaseComment" placeholder="Add a comment..." class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                    <x-primary-button type="submit">Submit Comment</x-primary-button>
                </form>
            @endif
        </div>

    </div>
</div>
