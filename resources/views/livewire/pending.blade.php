<div class="min-w-full align-middle overflow-auto max-w-4xl mx-auto pt-10 pr-4 pl-4 sm:pr-10 sm:pl-10" wire:poll.120000ms>
    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
        <!-- Clearance Table -->
        <div class="flex-1">
            <h2 class="text-lg font-semibold mb-2">Pending Clearance Applications</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full border divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 text-left bg-gray-50 sm:px-6 sm:py-3">
                                <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Name</span>
                            </th>
                            <th class="px-4 py-3 text-left bg-gray-50 sm:px-6 sm:py-3">
                                <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Type</span>
                            </th>
                            <th class="px-4 py-3 text-left bg-gray-50 sm:px-6 sm:py-3">
                                <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Date</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($clearances as $clearance)
                            <tr>
                                <td class="px-4 py-4 text-sm leading-5 text-gray-900 sm:px-6 sm:py-4">
                                    {{ $clearance->name }}
                                </td>
                                <td class="px-4 py-4 text-sm leading-5 text-gray-900 sm:px-6 sm:py-4">
                                    {{ $clearance->type->name ?? 'N/A' }}
                                </td>
                                <td class="px-4 py-4 text-sm leading-5 text-gray-900 sm:px-6 sm:py-4">
                                    {{ \Carbon\Carbon::parse($clearance->date)->format('M j, Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-5">
                    {{ $clearances->links() }}
                </div>
            </div>
        </div>

        <!-- Complaints Table -->
        <div class="flex-1">
            <h2 class="text-lg font-semibold mb-2">Pending Requests/Complaints</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full border divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 text-left bg-gray-50 sm:px-6 sm:py-3">
                                <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Name</span>
                            </th>
                            <th class="px-4 py-3 text-left bg-gray-50 sm:px-6 sm:py-3">
                                <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Title</span>
                            </th>
                            <th class="px-4 py-3 text-left bg-gray-50 sm:px-6 sm:py-3">
                                <span class="text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase">Date</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($complaints as $complaint)
                            <tr>
                                <td class="px-4 py-4 text-sm leading-5 text-gray-900 sm:px-6 sm:py-4">
                                    {{ $complaint->name }}
                                </td>
                                <td class="px-4 py-4 text-sm leading-5 text-gray-900 sm:px-6 sm:py-4">
                                    {{ $complaint->title }}
                                </td>
                                <td class="px-4 py-4 text-sm leading-5 text-gray-900 sm:px-6 sm:py-4">
                                    {{ \Carbon\Carbon::parse($complaint->created_at)->format('M j, Y') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-5">
                    {{ $complaints->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
