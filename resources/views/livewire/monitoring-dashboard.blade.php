<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #0f172a;
            color: #e2e8f0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .dashboard-container {
            padding: 2rem;
            max-width: 100%;
        }
        .section-title {
            font-size: 1.75rem;
            font-weight: bold;
            margin-bottom: 1rem;
            color: #60a5fa;
            border-bottom: 2px solid #3b82f6;
            padding-bottom: 0.5rem;
        }
        .card {
            background: #1e293b;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid #334155;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
        }
        .clearance-card {
            background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);
            border: 2px solid #3b82f6;
        }
        .item-row {
            padding: 1rem;
            margin-bottom: 0.75rem;
            background: #0f172a;
            border-radius: 0.375rem;
            border-left: 4px solid #3b82f6;
        }
        .item-row:hover {
            background: #1e293b;
        }
        .badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
        }
        .badge-pending {
            background: #fbbf24;
            color: #78350f;
        }
        .badge-new {
            background: #10b981;
            color: #064e3b;
        }
        .time-ago {
            color: #94a3b8;
            font-size: 0.875rem;
        }
        .grid-2 {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }
        .grid-3 {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }
        .count-badge {
            font-size: 2rem;
            font-weight: bold;
            color: #60a5fa;
        }
        @media (max-width: 1200px) {
            .grid-3 {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 768px) {
            .grid-2, .grid-3 {
                grid-template-columns: 1fr;
            }
            .section-title {
                font-size: 1.5rem;
            }
        }
        .empty-state {
            text-align: center;
            padding: 2rem;
            color: #64748b;
            font-style: italic;
        }
    </style>
    @livewireStyles
</head>
<body>
    <div class="dashboard-container" wire:poll.30s>
        <!-- Header with Summary Counts -->
        <div class="mb-6">
            <h1 class="text-4xl font-bold mb-4 text-center" style="color: #60a5fa;">
                <i class="fas fa-tv mr-3"></i>Monitoring Dashboard
            </h1>
            <div class="grid-3 mb-4">
                <div class="card text-center">
                    <div class="text-gray-400 mb-2">Pending Clearances</div>
                    <div class="count-badge">{{ $counts['pending_clearances'] }}</div>
                </div>
                <div class="card text-center">
                    <div class="text-gray-400 mb-2">Pending Complaints</div>
                    <div class="count-badge">{{ $counts['pending_complaints'] }}</div>
                </div>
                <div class="card text-center">
                    <div class="text-gray-400 mb-2">Pending Lupon Cases</div>
                    <div class="count-badge">{{ $counts['pending_lupon_cases'] }}</div>
                </div>
            </div>
        </div>

        <!-- Pending Clearances - PROMINENCE -->
        <div class="card clearance-card mb-6">
            <h2 class="section-title">
                <i class="fas fa-file-alt mr-2"></i>Pending Clearances ({{ $pendingClearances->count() }})
            </h2>
            @if($pendingClearances->count() > 0)
                <div class="grid-2">
                    @foreach($pendingClearances as $clearance)
                        <div class="item-row">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <div class="font-semibold text-lg mb-1">{{ $clearance->name }}</div>
                                    <div class="text-sm text-gray-300">
                                        <i class="fas fa-tag mr-1"></i>{{ $clearance->type->name ?? 'N/A' }}
                                    </div>
                                </div>
                                <span class="badge badge-pending">Pending</span>
                            </div>
                            <div class="text-sm text-gray-400 mt-2">
                                <i class="far fa-calendar mr-1"></i>
                                {{ \Carbon\Carbon::parse($clearance->date)->format('M j, Y') }}
                                <span class="time-ago ml-2">
                                    ({{ \Carbon\Carbon::parse($clearance->date)->diffForHumans() }})
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">No pending clearances</div>
            @endif
        </div>

        <!-- Other Sections in Grid -->
        <div class="grid-2">
            <!-- Pending Complaints -->
            <div class="card">
                <h2 class="section-title">
                    <i class="fas fa-exclamation-triangle mr-2"></i>Pending Complaints ({{ $pendingComplaints->count() }})
                </h2>
                @if($pendingComplaints->count() > 0)
                    @foreach($pendingComplaints->take(5) as $complaint)
                        <div class="item-row">
                            <div class="font-semibold mb-1">{{ $complaint->title }}</div>
                            <div class="text-sm text-gray-400">
                                <i class="fas fa-user mr-1"></i>{{ $complaint->name }}
                                <span class="time-ago ml-2">{{ $complaint->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @endforeach
                    @if($pendingComplaints->count() > 5)
                        <div class="text-center text-gray-400 mt-2">
                            +{{ $pendingComplaints->count() - 5 }} more
                        </div>
                    @endif
                @else
                    <div class="empty-state">No pending complaints</div>
                @endif
            </div>

            <!-- Pending Lupon Cases -->
            <div class="card">
                <h2 class="section-title">
                    <i class="fas fa-gavel mr-2"></i>Pending Lupon Cases ({{ $pendingLuponCases->count() }})
                </h2>
                @if($pendingLuponCases->count() > 0)
                    @foreach($pendingLuponCases->take(5) as $case)
                        <div class="item-row">
                            <div class="font-semibold mb-1">{{ $case->title ?? 'Case #' . $case->case_no }}</div>
                            <div class="text-sm text-gray-400">
                                <i class="far fa-calendar mr-1"></i>
                                {{ \Carbon\Carbon::parse($case->date)->format('M j, Y') }}
                                <span class="time-ago ml-2">{{ \Carbon\Carbon::parse($case->date)->diffForHumans() }}</span>
                            </div>
                        </div>
                    @endforeach
                    @if($pendingLuponCases->count() > 5)
                        <div class="text-center text-gray-400 mt-2">
                            +{{ $pendingLuponCases->count() - 5 }} more
                        </div>
                    @endif
                @else
                    <div class="empty-state">No pending lupon cases</div>
                @endif
            </div>
        </div>

        <!-- New Comments -->
        <div class="grid-2 mt-4">
            <div class="card">
                <h2 class="section-title">
                    <i class="fas fa-comments mr-2"></i>New Comments - Complaints ({{ $recentComplaintComments->count() }})
                </h2>
                @if($recentComplaintComments->count() > 0)
                    @foreach($recentComplaintComments->take(5) as $comment)
                        <div class="item-row">
                            <div class="font-semibold mb-1">{{ $comment->complaint->title ?? 'N/A' }}</div>
                            <div class="text-sm text-gray-300 mb-1">{{ \Illuminate\Support\Str::limit($comment->comment, 100) }}</div>
                            <div class="text-sm text-gray-400">
                                <i class="fas fa-user mr-1"></i>{{ $comment->user->name ?? 'Unknown' }}
                                <span class="badge badge-new ml-2">New</span>
                                <span class="time-ago ml-2">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">No new comments</div>
                @endif
            </div>

            <div class="card">
                <h2 class="section-title">
                    <i class="fas fa-comments mr-2"></i>New Comments - Lupon Cases ({{ $recentLuponComments->count() }})
                </h2>
                @if($recentLuponComments->count() > 0)
                    @foreach($recentLuponComments->take(5) as $comment)
                        <div class="item-row">
                            <div class="font-semibold mb-1">{{ $comment->luponCase->title ?? 'Case #' . ($comment->luponCase->case_no ?? 'N/A') }}</div>
                            <div class="text-sm text-gray-300 mb-1">{{ \Illuminate\Support\Str::limit($comment->comment, 100) }}</div>
                            <div class="text-sm text-gray-400">
                                <i class="fas fa-user mr-1"></i>{{ $comment->user->name ?? 'Unknown' }}
                                <span class="badge badge-new ml-2">New</span>
                                <span class="time-ago ml-2">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">No new comments</div>
                @endif
            </div>
        </div>

        <!-- Latest Incidents & Blotters -->
        <div class="grid-2 mt-4">
            <div class="card">
                <h2 class="section-title">
                    <i class="fas fa-exclamation-circle mr-2"></i>Latest Incidents ({{ $latestIncidents->count() }})
                </h2>
                @if($latestIncidents->count() > 0)
                    @foreach($latestIncidents->take(5) as $incident)
                        <div class="item-row">
                            <div class="font-semibold mb-1">{{ $incident->title }}</div>
                            <div class="text-sm text-gray-400">
                                <i class="fas fa-user mr-1"></i>{{ $incident->name }}
                                <span class="time-ago ml-2">{{ $incident->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">No recent incidents</div>
                @endif
            </div>

            <div class="card">
                <h2 class="section-title">
                    <i class="fas fa-file-alt mr-2"></i>Latest Blotters ({{ $latestBlotters->count() }})
                </h2>
                @if($latestBlotters->count() > 0)
                    @foreach($latestBlotters->take(5) as $blotter)
                        <div class="item-row">
                            <div class="font-semibold mb-1">{{ $blotter->incident }}</div>
                            <div class="text-sm text-gray-400">
                                <i class="fas fa-user mr-1"></i>{{ $blotter->firstname }} {{ $blotter->lastname }}
                                <span class="time-ago ml-2">{{ $blotter->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">No recent blotters</div>
                @endif
            </div>
        </div>

        <!-- Today's Schedules -->
        <div class="grid-2 mt-4">
            <div class="card">
                <h2 class="section-title">
                    <i class="fas fa-building mr-2"></i>Facility Schedules Today ({{ $todayFacilitySchedules->count() }})
                </h2>
                @if($todayFacilitySchedules->count() > 0)
                    @foreach($todayFacilitySchedules->take(5) as $schedule)
                        <div class="item-row">
                            <div class="font-semibold mb-1">{{ $schedule->facility->name ?? 'N/A' }}</div>
                            <div class="text-sm text-gray-300 mb-1">{{ $schedule->name }}</div>
                            <div class="text-sm text-gray-400">
                                <i class="far fa-clock mr-1"></i>
                                {{ \Carbon\Carbon::parse($schedule->start)->format('g:i A') }} - 
                                {{ \Carbon\Carbon::parse($schedule->end)->format('g:i A') }}
                                <span class="badge badge-pending ml-2">{{ $schedule->status }}</span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">No facility schedules today</div>
                @endif
            </div>

            <div class="card">
                <h2 class="section-title">
                    <i class="fas fa-car mr-2"></i>Vehicle Schedules Today ({{ $todayVehicleSchedules->count() }})
                </h2>
                @if($todayVehicleSchedules->count() > 0)
                    @foreach($todayVehicleSchedules->take(5) as $schedule)
                        <div class="item-row">
                            <div class="font-semibold mb-1">{{ $schedule->vehicle->name ?? 'N/A' }}</div>
                            <div class="text-sm text-gray-300 mb-1">{{ $schedule->name }}</div>
                            <div class="text-sm text-gray-400">
                                <i class="far fa-clock mr-1"></i>
                                {{ \Carbon\Carbon::parse($schedule->start)->format('g:i A') }} - 
                                {{ \Carbon\Carbon::parse($schedule->end)->format('g:i A') }}
                                <span class="badge badge-pending ml-2">{{ $schedule->status }}</span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-state">No vehicle schedules today</div>
                @endif
            </div>
        </div>

        <!-- Footer with Last Update Time -->
        <div class="text-center mt-6 text-gray-500 text-sm">
            <i class="fas fa-sync-alt mr-2"></i>Last updated: {{ now()->format('M j, Y g:i A') }} | Auto-refreshing every 30 seconds
        </div>
    </div>

    @livewireScripts
</body>
</html>

