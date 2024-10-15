<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    <div class="pt-3 sm:pt-5">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{!! $clearance->type->name !!}</h3>
        
        <div class="mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">
            <p>
                <span class="font-bold">{!! $clearance->name !!} | {!! $clearance->contact_number !!}</span>
            </p>
            <table>
                <tbody>
                    <tr>
                        <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Date:</td>
                        <td style="font-size: 14px;">{!! $clearance->date !!}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Amount:</td>
                        <td style="font-size: 14px;">{!! $clearance->amount !!}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Notes:</td>
                        <td style="font-size: 14px;">{!! $clearance->notes !!}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Complete Address:</td>
                        <td style="font-size: 14px;">{!! $clearance->address !!}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Status:</td>
                        <td style="font-size: 14px;">{!! $clearance->status !!}</td>
                    </tr>
                </tbody>
            </table>
            <h3 class="font-semibold">Attachments:</h3>
            <ul class="list-disc list-inside space-y-2">
                @foreach($clearance->assets as $attachment)
                    <li>
                        <a href="{{ Storage::url($attachment->path) }}" target="_blank" class="text-blue-500 hover:underline">
                            {{ basename($attachment->path) }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        @if ($clearance->status === 'Done')
            <div class="flex justify-between">
                <span class="font-semibold">Approved By:</span> 
                <span class="flex-grow">
                    {!!$clearance->approvedBy->name!!}
                </span>
            </div>
        @endif
    </div>
</div>
