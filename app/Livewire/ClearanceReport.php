<?php

namespace App\Livewire;

use App\Models\Clearance as ClearanceModel;
use App\Models\ClearanceType;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ClearanceReport extends Component
{
    public $startDate;
    public $endDate;

    public function mount(): void
    {
        // Only allow superadmin, administrator, and support access
        if (!auth()->user() || !auth()->user()->hasRole('superadmin|administrator|support')) {
            abort(403, 'Unauthorized access');
        }

        // Set default date range to last 30 days
        $this->endDate = Carbon::now()->format('Y-m-d');
        $this->startDate = Carbon::now()->subDays(30)->format('Y-m-d');
    }

    public function updatedStartDate()
    {
        // Reset if end date is before start date
        if ($this->endDate && $this->startDate > $this->endDate) {
            $this->endDate = $this->startDate;
        }
    }

    public function updatedEndDate()
    {
        // Reset if start date is after end date
        if ($this->startDate && $this->endDate < $this->startDate) {
            $this->startDate = $this->endDate;
        }
    }

    public function resetFilters()
    {
        $this->endDate = Carbon::now()->format('Y-m-d');
        $this->startDate = Carbon::now()->subDays(30)->format('Y-m-d');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function render(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        // Build base query with date range
        $tableName = (new ClearanceModel())->getTable();
        $query = ClearanceModel::query();
        
        if ($this->startDate) {
            $query->whereRaw("DATE({$tableName}.created_at) >= ?", [$this->startDate]);
        }
        
        if ($this->endDate) {
            $query->whereRaw("DATE({$tableName}.created_at) <= ?", [$this->endDate]);
        }

        // Total Statistics
        $totalClearances = (clone $query)->count();
        $pendingClearances = (clone $query)->where("{$tableName}.status", 'Pending')->count();
        $doneClearances = (clone $query)->where("{$tableName}.status", 'Done')->count();
        $totalAmount = (clone $query)->sum("{$tableName}.amount");

        // Clearances by Type
        $clearancesByType = (clone $query)
            ->select('clearance_types.name', DB::raw('count(*) as count'), DB::raw("sum({$tableName}.amount) as total_amount"))
            ->join('clearance_types', "{$tableName}.type_id", '=', 'clearance_types.id')
            ->groupBy('clearance_types.id', 'clearance_types.name')
            ->orderBy('count', 'desc')
            ->get();

        // Clearances by User (who requested)
        $clearancesByUser = (clone $query)
            ->select('users.name', 'users.email', DB::raw('count(*) as count'))
            ->join('users', "{$tableName}.user_id", '=', 'users.id')
            ->groupBy('users.id', 'users.name', 'users.email')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get();

        // Clearances by Approver
        $clearancesByApprover = (clone $query)
            ->whereNotNull("{$tableName}.approved_by")
            ->select('users.name', 'users.email', DB::raw('count(*) as count'))
            ->join('users', "{$tableName}.approved_by", '=', 'users.id')
            ->groupBy('users.id', 'users.name', 'users.email')
            ->orderBy('count', 'desc')
            ->get();

        // Average Issuance Time (for completed clearances)
        $completedClearances = (clone $query)
            ->where("{$tableName}.status", 'Done')
            ->whereNotNull("{$tableName}.approved_by")
            ->get();

        $totalHours = 0;
        $count = $completedClearances->count();
        
        foreach ($completedClearances as $clearance) {
            $hours = Carbon::parse($clearance->created_at)->diffInHours(Carbon::parse($clearance->updated_at));
            $totalHours += $hours;
        }

        $avgHours = $count > 0 ? round($totalHours / $count, 2) : 0;
        $avgDays = round($avgHours / 24, 2);

        // Daily statistics for the date range
        $dailyStats = (clone $query)
            ->selectRaw("DATE({$tableName}.created_at) as date, COUNT(*) as count, COALESCE(SUM({$tableName}.amount), 0) as total_amount")
            ->groupBy(DB::raw("DATE({$tableName}.created_at)"))
            ->orderBy('date', 'asc')
            ->get();

        // Status breakdown
        $statusBreakdown = (clone $query)
            ->select("{$tableName}.status", DB::raw('count(*) as count'))
            ->groupBy("{$tableName}.status")
            ->get()
            ->pluck('count', 'status');

        return view('livewire.clearance.report', [
            'totalClearances' => $totalClearances,
            'pendingClearances' => $pendingClearances,
            'doneClearances' => $doneClearances,
            'totalAmount' => $totalAmount,
            'clearancesByType' => $clearancesByType,
            'clearancesByUser' => $clearancesByUser,
            'clearancesByApprover' => $clearancesByApprover,
            'avgHours' => $avgHours,
            'avgDays' => $avgDays,
            'dailyStats' => $dailyStats,
            'statusBreakdown' => $statusBreakdown,
        ]);
    }
}

