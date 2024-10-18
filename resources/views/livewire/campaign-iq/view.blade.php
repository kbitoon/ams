<div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
    <button class="absolute top-2 right-2 text-gray-600 hover:text-gray-800 focus:outline-none text-3xl" wire:click="closeModal">
        &times;
    </button>
    <div class="pt-3 sm:pt-5">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">{!! $campaignIq->firstname !!} {!! $campaignIq->familyname !!}</h3>
        
        <div class="mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">
            <table width="100%">
                <tbody>
                    <tr>
                        <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Date of Birth:</td>
                        <td style="font-size: 14px;">{!! $campaignIq->birthdate !!}</td>
                    </tr>
                    <tr style="background: #eeeeee">
                        <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Address:</td>
                        <td style="font-size: 14px;">{!! $campaignIq->address !!}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Sitio:</td>
                        <td style="font-size: 14px;">{!! $campaignIq->sitio !!}</td>
                    </tr>
                    <tr style="background: #eeeeee">
                        <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">City:</td>
                        <td style="font-size: 14px;">{!! $campaignIq->city !!}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Province:</td>
                        <td style="font-size: 14px;">{!! $campaignIq->province !!}</td>
                    </tr>
                    <tr style="background: #eeeeee">
                        <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Contact Number:</td>
                        <td style="font-size: 14px;">{!! $campaignIq->contact_number !!}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Upline:</td>
                        <td style="font-size: 14px;">{!! $campaignIq->upline !!}</td>
                    </tr>
                    <tr style="background: #eeeeee">
                        <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Government Position:</td>
                        <td style="font-size: 14px;">{!! $campaignIq->government_position !!}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Sector:</td>
                        <td style="font-size: 14px;">{!! $campaignIq->sector !!}</td>
                    </tr>
                    <tr style="background: #eeeeee">
                        <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Remarks:</td>
                        <td style="font-size: 14px;">{!! $campaignIq->remarks !!}</td>
                    </tr>
                    <tr>
                        <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Status</td>
                        <td style="font-size: 14px;">{!! $campaignIq->status !!}</td>
                    </tr>
                    <tr style="background: #eeeeee">
                        <td class="font-semibold mt-4 text-sm relaxed text-gray-800 dark:text-gray-300">Commitment</td>
                        <td style="font-size: 14px;">{!! $campaignIq->commitment !!}</td>
                    </tr>
                </tbody>
            </table>
    </div>
</div>
