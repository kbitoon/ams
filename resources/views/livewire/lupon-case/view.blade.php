<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    <div class="pt-3 sm:pt-5">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100"></h3>
        
        <div class="mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">
            <p>
                <span class="font-bold uppercase">{!! $luponCase->date !!}</span>
            </p>
            <table width="100%">
                <tbody>
                    <tr>
                        <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Case #:</td>
                        <td style="font-size: 14px;">{!! $luponCase->case_no !!}</td>
                    </tr>
                    <tr style="background: #eeeeee">
                        <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Prayer:</td>
                        <td style="font-size: 14px;">{!! $luponCase->prayer !!}</td>
                    </tr>
                </tbody>
            </table>
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

    </div>
</div>
