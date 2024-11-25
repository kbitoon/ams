<div class="min-w-full align-middle p-6 relative">
    <!-- Close button -->
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    <div class="pt-3 sm:pt-5">
        <h2 class="text-xl font-semibold text-black dark:text-white">Complainant
        </h2>
        <table class="mt-4 text-sm text-gray-800 dark:text-gray-300">
            <tbody>
                <tr>
                    <td class="py-2"><span class="font-semibold">Full Name:</span></td>
                    <td class="py-2">{{ trim("{$blotter->firstname} {$blotter->middle} {$blotter->lastname}") }} </td>
                </tr>
                <tr>
                    <td class="py-2"><span class="font-semibold">Contact:</span></td>
                    <td class="py-2">{{$blotter->contact}} </td>
                </tr>
                <tr>
                    <td class="py-2"><span class="font-semibold">Address:</span></td>
                    <td class="py-2">{{$blotter->address}} </td>
                </tr>
                <tr>
                    <td class="py-2"><span class="font-semibold">Civil Status:</span></td>
                    <td class="py-2">{{$blotter->civil}} </td>
                </tr>
                <tr>
                    <td class="py-2"><span class="font-semibold">Date of Birth:</span></td>
                    <td class="py-2">{{ \Carbon\Carbon::parse($blotter->date_of_birth)->format('F j, Y') }}</td>
                </tr>
                <tr>
                    <td class="py-2"><span class="font-semibold">Date of Incident:</span></td>
                    <td class="py-2">{{ \Carbon\Carbon::parse($blotter->incident)->format('F j, Y g:i A') }}</td>
                </tr>
                <tr>
                    <td class="py-2"><span class="font-semibold">Date Reported:</span></td>
                    <td class="py-2">{{ \Carbon\Carbon::parse($blotter->reported)->format('F j, Y g:i A') }}</td>
                </tr>
                <tr>
                    <td class="py-2"><span class="font-semibold">Place of Birith:</span></td>
                    <td class="py-2">{!! $blotter->place_of_birth ? $blotter->place_of_birth : "No place of birth added." !!}</td>
                </tr>
                <tr>
                    <td class="py-2"><span class="font-semibold">Occupation:</span></td>
                    <td class="py-2">{!! $blotter->occupation ? $blotter->occupation: "No occupation added." !!} </td>
                </tr>
                <tr>
                    <td class="py-2"><span class="font-semibold">Narration:</span></td>
                    <td class="py-2">{{ $blotter->narration }}</td>
                </tr>
            </tbody>
        </table>

    </div>
</div>
