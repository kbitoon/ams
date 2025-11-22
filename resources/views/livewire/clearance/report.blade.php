<div class="p-6" x-data="{ activeView: 'summary' }">
    <!-- Date Range Filters -->
    <div class="mb-6 bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 sm:p-5">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Date Range Filter</h3>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <x-input-label for="startDate" value="Start Date" />
                <input 
                    type="date" 
                    wire:model.live="startDate" 
                    id="startDate"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                >
            </div>
            <div>
                <x-input-label for="endDate" value="End Date" />
                <input 
                    type="date" 
                    wire:model.live="endDate" 
                    id="endDate"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                >
            </div>
            <div class="flex items-end">
                <x-secondary-button wire:click="resetFilters" class="w-full sm:w-auto">
                    Reset to Last 30 Days
                </x-secondary-button>
            </div>
        </div>
    </div>

    <!-- Summary Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Total Clearances -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-5 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Clearances</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 mt-1">{{ number_format($totalClearances) }}</p>
                </div>
                <div class="p-3 bg-blue-100 dark:bg-blue-900/20 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-600 dark:text-blue-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pending Clearances -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-5 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Pending</p>
                    <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400 mt-1">{{ number_format($pendingClearances) }}</p>
                </div>
                <div class="p-3 bg-yellow-100 dark:bg-yellow-900/20 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-yellow-600 dark:text-yellow-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Completed Clearances -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-5 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Completed</p>
                    <p class="text-2xl font-bold text-green-600 dark:text-green-400 mt-1">{{ number_format($doneClearances) }}</p>
                </div>
                <div class="p-3 bg-green-100 dark:bg-green-900/20 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-green-600 dark:text-green-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Amount -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-5 border border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Amount</p>
                    <p class="text-2xl font-bold text-indigo-600 dark:text-indigo-400 mt-1">₱{{ number_format($totalAmount, 2) }}</p>
                </div>
                <div class="p-3 bg-indigo-100 dark:bg-indigo-900/20 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-indigo-600 dark:text-indigo-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Statistics -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Average Issuance Time -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-5 border border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Average Issuance Time</h3>
            <div class="space-y-2">
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600 dark:text-gray-400">Average Hours:</span>
                    <span class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ number_format($avgHours, 2) }} hours</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-600 dark:text-gray-400">Average Days:</span>
                    <span class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ number_format($avgDays, 2) }} days</span>
                </div>
            </div>
        </div>

        <!-- Status Breakdown -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-5 border border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Status Breakdown</h3>
            <div class="space-y-3">
                @foreach($statusBreakdown as $status => $count)
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $status }}</span>
                        <div class="flex items-center gap-2">
                            <div class="w-32 bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                <div class="bg-indigo-600 dark:bg-indigo-400 h-2 rounded-full" style="width: {{ $totalClearances > 0 ? ($count / $totalClearances * 100) : 0 }}%"></div>
                            </div>
                            <span class="text-sm font-semibold text-gray-900 dark:text-gray-100 w-12 text-right">{{ $count }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Detailed Reports -->
    <div class="space-y-6">
        <!-- Clearances by Type -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-5 border border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Clearances by Type</h3>
            <!-- Desktop Table -->
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-900">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Count</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Percentage</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($clearancesByType as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $item->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ number_format($item->count) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">₱{{ number_format($item->total_amount, 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $totalClearances > 0 ? number_format(($item->count / $totalClearances) * 100, 1) : 0 }}%
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Mobile Cards -->
            <div class="md:hidden space-y-3">
                @forelse($clearancesByType as $item)
                    <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 border border-gray-200 dark:border-gray-700">
                        <div class="font-semibold text-gray-900 dark:text-gray-100 mb-2">{{ $item->name }}</div>
                        <div class="grid grid-cols-2 gap-2 text-sm">
                            <div>
                                <span class="text-gray-600 dark:text-gray-400">Count:</span>
                                <span class="font-medium text-gray-900 dark:text-gray-100 ml-1">{{ number_format($item->count) }}</span>
                            </div>
                            <div>
                                <span class="text-gray-600 dark:text-gray-400">Amount:</span>
                                <span class="font-medium text-gray-900 dark:text-gray-100 ml-1">₱{{ number_format($item->total_amount, 2) }}</span>
                            </div>
                            <div class="col-span-2">
                                <span class="text-gray-600 dark:text-gray-400">Percentage:</span>
                                <span class="font-medium text-gray-900 dark:text-gray-100 ml-1">
                                    {{ $totalClearances > 0 ? number_format(($item->count / $totalClearances) * 100, 1) : 0 }}%
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-sm text-gray-500 dark:text-gray-400 py-4">No data available</div>
                @endforelse
            </div>
        </div>

        <!-- Clearances by User -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-5 border border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Top Requesters</h3>
            <!-- Desktop Table -->
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-900">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Requests</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($clearancesByUser as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ number_format($user->count) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Mobile Cards -->
            <div class="md:hidden space-y-3">
                @forelse($clearancesByUser as $user)
                    <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 border border-gray-200 dark:border-gray-700">
                        <div class="font-semibold text-gray-900 dark:text-gray-100 mb-1">{{ $user->name }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ $user->email }}</div>
                        <div class="text-sm">
                            <span class="text-gray-600 dark:text-gray-400">Total Requests:</span>
                            <span class="font-medium text-gray-900 dark:text-gray-100 ml-1">{{ number_format($user->count) }}</span>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-sm text-gray-500 dark:text-gray-400 py-4">No data available</div>
                @endforelse
            </div>
        </div>

        <!-- Clearances by Approver -->
        @if($clearancesByApprover->count() > 0)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-5 border border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Clearances by Approver</h3>
            <!-- Desktop Table -->
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-900">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Approved Count</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($clearancesByApprover as $approver)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">{{ $approver->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $approver->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ number_format($approver->count) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Mobile Cards -->
            <div class="md:hidden space-y-3">
                @foreach($clearancesByApprover as $approver)
                    <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 border border-gray-200 dark:border-gray-700">
                        <div class="font-semibold text-gray-900 dark:text-gray-100 mb-1">{{ $approver->name }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400 mb-2">{{ $approver->email }}</div>
                        <div class="text-sm">
                            <span class="text-gray-600 dark:text-gray-400">Approved:</span>
                            <span class="font-medium text-gray-900 dark:text-gray-100 ml-1">{{ number_format($approver->count) }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Daily Statistics -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-5 border border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Daily Statistics</h3>
            <!-- Desktop Table -->
            <div class="hidden md:block overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-900">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Count</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Amount</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($dailyStats as $stat)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                    {{ \Carbon\Carbon::parse($stat->date)->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ number_format($stat->count) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">₱{{ number_format($stat->total_amount, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Mobile Cards -->
            <div class="md:hidden space-y-3">
                @forelse($dailyStats as $stat)
                    <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 border border-gray-200 dark:border-gray-700">
                        <div class="font-semibold text-gray-900 dark:text-gray-100 mb-2">
                            {{ \Carbon\Carbon::parse($stat->date)->format('M d, Y') }}
                        </div>
                        <div class="grid grid-cols-2 gap-2 text-sm">
                            <div>
                                <span class="text-gray-600 dark:text-gray-400">Count:</span>
                                <span class="font-medium text-gray-900 dark:text-gray-100 ml-1">{{ number_format($stat->count) }}</span>
                            </div>
                            <div>
                                <span class="text-gray-600 dark:text-gray-400">Amount:</span>
                                <span class="font-medium text-gray-900 dark:text-gray-100 ml-1">₱{{ number_format($stat->total_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-sm text-gray-500 dark:text-gray-400 py-4">No data available</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

