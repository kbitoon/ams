<div class="min-w-full align-middle p-6 relative">
    <!-- Close button -->
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    
    <div class="pt-3 sm:pt-5">
        <h2 class="text-xl font-semibold text-black dark:text-white text-center">Blotter Details</h2>
        
        <!-- Complainant and Complainee Side-by-Side -->
        <div class="grid grid-cols-1 gap-6 mt-4">
            <!-- Complainant Details -->
            <div>
                <h3 class="text-lg font-semibold text-black dark:text-white">Complainant</h3>
                <table class="mt-2 text-sm text-gray-800 dark:text-gray-300">
                    <tbody>
                        <tr>
                            <td class="py-2"><span class="font-semibold">Full Name:</span></td>
                            <td class="py-2">{{ trim("{$blotter->firstname} {$blotter->middle} {$blotter->lastname}") }}</td>
                        </tr>
                        <tr>
                            <td class="py-2"><span class="font-semibold">Contact:</span></td>
                            <td class="py-2">{{$blotter->contact}}</td>
                        </tr>
                        <tr>
                            <td class="py-2"><span class="font-semibold">Address:</span></td>
                            <td class="py-2">{{$blotter->address}}</td>
                        </tr>
                        <tr>
                            <td class="py-2"><span class="font-semibold">Civil Status:</span></td>
                            <td class="py-2">{{$blotter->civil}}</td>
                        </tr>
                        <tr>
                            <td class="py-2"><span class="font-semibold">Date of Birth:</span></td>
                            <td class="py-2">{{ \Carbon\Carbon::parse($blotter->date_of_birth)->format('F j, Y') }}</td>
                        </tr>
                        <tr>
                            <td class="py-2"><span class="font-semibold">Place of Birth:</span></td>
                            <td class="py-2">{!! $blotter->place_of_birth ? $blotter->place_of_birth : "No place of birth added." !!}</td>
                        </tr>
                        <tr>
                            <td class="py-2"><span class="font-semibold">Occupation:</span></td>
                            <td class="py-2">{!! $blotter->occupation ? $blotter->occupation : "No occupation added." !!}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Complainee Details -->
            <div>
                <h3 class="text-lg font-semibold text-black dark:text-white">Complainee</h3>
                @if($blotter->complainee)
                    <table class="mt-2 text-sm text-gray-800 dark:text-gray-300">
                        <tbody>
                            <tr>
                                <td class="py-2"><span class="font-semibold">Full Name:</span></td>
                                <td class="py-2">{{ trim("{$blotter->complainee->first} {$blotter->complainee->middle} {$blotter->complainee->last}") }}</td>
                            </tr>
                            <tr>
                                <td class="py-2"><span class="font-semibold">Contact:</span></td>
                                <td class="py-2">{{ $blotter->complainee->contact }}</td>
                            </tr>
                            <tr>
                                <td class="py-2"><span class="font-semibold">Address:</span></td>
                                <td class="py-2">{{ $blotter->complainee->address }}</td>
                            </tr>
                            <tr>
                                <td class="py-2"><span class="font-semibold">Civil Status:</span></td>
                                <td class="py-2">{{ $blotter->complainee->civil_status }}</td>
                            </tr>
                            <tr>
                                <td class="py-2"><span class="font-semibold">Date of Birth:</span></td>
                                <td class="py-2">{{ \Carbon\Carbon::parse($blotter->complainee->date_of_birth)->format('F j, Y') }}</td>
                            </tr>
                            <tr>
                                <td class="py-2"><span class="font-semibold">Place of Birth:</span></td>
                                <td class="py-2">{{ $blotter->complainee->place_of_birth ?? 'No place of birth added.' }}</td>
                            </tr>
                            <tr>
                                <td class="py-2"><span class="font-semibold">Occupation:</span></td>
                                <td class="py-2">{{ $blotter->complainee->occupation ?? 'No occupation added.' }}</td>
                            </tr>
                            <tr>
                                <td class="py-2"><span class="font-semibold">Influence:</span></td>
                                <td class="py-2">{{ $blotter->complainee->influence ?? 'No influence added.' }}</td>
                            </tr>
                        </tbody>
                    </table>
                @else
                    <p class="mt-2 text-gray-600 dark:text-gray-400">No complainee assigned yet.</p>
                @endif
            </div>
        </div>

        <!-- Other Details -->
        <h3 class="mt-6 text-lg font-semibold text-black dark:text-white">Incident Details</h3>
        <table class="mt-2 text-sm text-gray-800 dark:text-gray-300">
            <tbody>
                <tr>
                    <td class="py-2"><span class="font-semibold">Date of Incident:</span></td>
                    <td class="py-2">{{ \Carbon\Carbon::parse($blotter->incident)->format('F j, Y g:i A') }}</td>
                </tr>
                <tr>
                    <td class="py-2"><span class="font-semibold">Date Reported:</span></td>
                    <td class="py-2">{{ \Carbon\Carbon::parse($blotter->reported)->format('F j, Y g:i A') }}</td>
                </tr>
                <tr>
                    <td class="py-2"><span class="font-semibold">Narration:</span></td>
                    <td class="py-2">{{ $blotter->narration }}</td>
                </tr>
            </tbody>
        </table>

        <div class="flex justify-between mt-4">
            <span class="font-semibold mr-2">Recorded By:</span> 
            <span class="flex-grow">{!! $blotter->user->name !!}</span>
        </div>
    </div>
</div>
