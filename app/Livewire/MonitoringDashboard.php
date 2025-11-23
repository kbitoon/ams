<?php

namespace App\Livewire;

use App\Models\Clearance;
use App\Models\Complaint;
use App\Models\LuponCase;
use App\Models\Comment;
use App\Models\LuponCaseComment;
use App\Models\IncidentReport;
use App\Models\Blotter;
use App\Models\FacilitySchedule;
use App\Models\VehicleSchedule;
use Carbon\Carbon;
use Livewire\Component;

class MonitoringDashboard extends Component
{
    /**
     * Render the monitoring dashboard
     * This page is public (no authentication required) and auto-updates
     */
    public function render()
    {
        $today = Carbon::today();
        
        // Pending Clearances (PROMINENCE - show more details)
        $pendingClearances = Clearance::where('status', 'Pending')
            ->with('type')
            ->orderBy('date', 'asc')
            ->limit(5)
            ->get();

        // Pending Complaints
        $pendingComplaints = Complaint::where('status', 'Pending')
            ->orderBy('created_at', 'asc')
            ->limit(5)
            ->get();

        // Pending Lupon Cases
        $pendingLuponCases = LuponCase::where('status', 'pending')
            ->orderBy('date', 'asc')
            ->limit(5)
            ->get();

        // New Comments (last 24 hours) for Complaints
        $recentComplaintComments = Comment::where('created_at', '>=', Carbon::now()->subDay())
            ->with(['complaint', 'user'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // New Comments (last 24 hours) for Lupon Cases
        $recentLuponComments = LuponCaseComment::where('created_at', '>=', Carbon::now()->subDay())
            ->with(['luponCase', 'user'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Latest Incidents (last 7 days)
        $latestIncidents = IncidentReport::where('created_at', '>=', Carbon::now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Latest Blotters (last 7 days)
        $latestBlotters = Blotter::where('created_at', '>=', Carbon::now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Facility Schedules for Today
        $todayFacilitySchedules = FacilitySchedule::whereDate('start', $today)
            ->with('facility', 'user')
            ->orderBy('start', 'asc')
            ->limit(5)
            ->get();

        // Vehicle Schedules for Today
        $todayVehicleSchedules = VehicleSchedule::whereDate('start', $today)
            ->with('vehicle', 'user')
            ->orderBy('start', 'asc')
            ->limit(5)
            ->get();

        // Counts for summary
        $counts = [
            'pending_clearances' => Clearance::where('status', 'Pending')->count(),
            'pending_complaints' => Complaint::where('status', 'Pending')->count(),
            'pending_lupon_cases' => LuponCase::where('status', 'pending')->count(),
            'new_comments' => Comment::where('created_at', '>=', Carbon::now()->subDay())->count() +
                             LuponCaseComment::where('created_at', '>=', Carbon::now()->subDay())->count(),
        ];

        return view('livewire.monitoring-dashboard', [
            'pendingClearances' => $pendingClearances,
            'pendingComplaints' => $pendingComplaints,
            'pendingLuponCases' => $pendingLuponCases,
            'recentComplaintComments' => $recentComplaintComments,
            'recentLuponComments' => $recentLuponComments,
            'latestIncidents' => $latestIncidents,
            'latestBlotters' => $latestBlotters,
            'todayFacilitySchedules' => $todayFacilitySchedules,
            'todayVehicleSchedules' => $todayVehicleSchedules,
            'counts' => $counts,
            'today' => $today,
        ]);
    }
}

