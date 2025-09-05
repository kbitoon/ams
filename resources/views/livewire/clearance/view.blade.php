<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl"
        wire:click="closeModal">
        &times;
    </button>
    @php
        $pdfRoutes = [
            'Certification' => 'certificate.download',
            'Certificate of Indigency' => 'indigency.download',
        ];
        $typeName = optional($clearance->type)->name;
    @endphp

    @if(isset($pdfRoutes[$typeName]))
        <div class="absolute top-12 right-12">
            <a href="{{ route($pdfRoutes[$typeName], $clearance->id) }}" target="_blank"
                class="absolute text-red-600 hover:text-red-800 focus:outline-none" title="Download PDF">
                <!-- Heroicon: Document Arrow Down -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                    <path d="M6 2a2 2 0 00-2 2v16c0 1.1.9 2 2 2h12a2 
                                 2 0 002-2V8l-6-6H6z" />
                    <text x="6" y="17" font-size="7" font-weight="bold" fill="white">PDF</text>
                </svg>
            </a>
        </div>
    @endif

    <div class="pt-3 sm:pt-5">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{!! $clearance->type->name !!}</h3>

        <div class="mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">
            <p>
                <span class="font-bold uppercase">{!! $clearance->name !!} | {!! $clearance->contact_number !!}</span>
            </p>
            <table width="100%">
                <tbody>
                    <tr>
                        <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Date of Birth:
                        </td>
                        <td style="font-size: 14px;">{!! $clearance->date_of_birth !!}</td>
                    </tr>
                    <tr style="background: #eeeeee">
                        <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Age:</td>
                        <td style="font-size: 14px;">{!! $clearance->age !!}</td>
                    </tr>

                    <tr>
                        <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Gender:</td>
                        <td style="font-size: 14px;">{!! $clearance->sex !!}</td>
                    </tr>
                    <tr style="background: #eeeeee">
                        <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Civil Status:
                        </td>
                        <td style="font-size: 14px;">{!! $clearance->civil_status !!}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Precinct No.:
                        </td>
                        <td style="font-size: 14px;">{!! $clearance->precinct_no !!}</td>
                    </tr>
                    <tr style="background: #eeeeee">
                        <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Date:</td>
                        <td style="font-size: 14px;">{!! $clearance->date !!}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Amount:</td>
                        <td style="font-size: 14px;">{!! $clearance->amount !!}</td>
                    </tr>
                    <tr style="background: #eeeeee">
                        <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Notes:</td>
                        <td style="font-size: 14px;">{!! $clearance->notes !!}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Complete
                            Address:</td>
                        <td class="uppercase font-bold" style="font-size: 14px;">{!! $clearance->address !!}</td>
                    </tr>
                    <tr style="background: #eeeeee">
                        <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Purpose:</td>
                        <td style="font-size: 14px;">{!! $clearance->purpose !!}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Status:</td>
                        <td style="font-size: 14px;">{!! $clearance->status !!}</td>
                    </tr>
                </tbody>
            </table>
            @if(!$clearance->assets->isEmpty())
                <h3 class="font-semibold">Attachments:</h3>
                <ul class="list-disc list-inside space-y-2">
                    @foreach($clearance->assets as $attachment)
                        <li>
                            <a href="{{ Storage::url($attachment->path) }}" target="_blank"
                                class="text-blue-500 hover:underline">
                                {{ basename($attachment->path) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        @if ($clearance->status === 'Done')
            <div class="flex justify-between">
                <span class="font-semibold mr-2">Approved By:</span>
                <span class="flex-grow">
                    {!!$clearance->approvedBy->name!!}
                </span>
            </div>
        @endif
    </div>
</div>