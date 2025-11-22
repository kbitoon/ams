<?php

namespace App\Livewire;

use App\Models\Clearance as ClearanceModel;
use App\Models\ClearanceType;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;
use Carbon\Carbon;

class Clearance extends Component
{
    use WithPagination, WithoutUrlPagination;

    public string $search = '';
    public string $filterStatus = '';
    public string $filterTypeId = '';

    protected $updatesQueryString = ['search', 'filterStatus', 'filterTypeId'];

    #[On('refresh-list')]
    public function refresh() {}

    public function markAsDone($clearanceId)
    {
        $clearance = ClearanceModel::find($clearanceId);
    
        if ($clearance && auth()->check()) { 
            $clearance->status = 'Done';
            $clearance->approved_by = auth()->user()->id; 
            $clearance->save();
        }
    }
    

    public function searchClearance()
    {
        $this->resetPage(); // Reset pagination to the first page
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->filterStatus = '';
        $this->filterTypeId = '';
        $this->resetPage();
    }

    public function getTimeAgo($clearanceDate)
    {
        $clearanceDate = Carbon::parse($clearanceDate);
        $now = Carbon::now();
    
        $diffInSeconds = $clearanceDate->diffInSeconds($now);

        if ($diffInSeconds < 3600) {
            $minutes = floor($clearanceDate->diffInMinutes($now));
            return $minutes . ' minute' . ($minutes > 1 ? 's' : '') . ' ago';
        }
        if ($diffInSeconds < 86400) {
            $hours = floor($clearanceDate->diffInHours($now));
            return $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ago';
        }
        $days = floor($clearanceDate->diffInDays($now));
        return $days . ' day' . ($days > 1 ? 's' : '') . ' ago';
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function render(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $query = ClearanceModel::with('assets');

        // First, prioritize Pending clearances
        $query->orderByRaw("CASE WHEN status = 'Pending' THEN 0 ELSE 1 END")
            ->orderBy('date', 'desc');

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        if ($this->filterStatus !== '') {
            $query->where('status', $this->filterStatus);
        }

        if ($this->filterTypeId !== '') {
            $query->where('type_id', $this->filterTypeId);
        }

        if (auth()->user()->hasRole('superadmin|administrator|support')) {
            $clearances = $query->paginate(10);
        } else {
            $clearances = $query->where('user_id', auth()->user()->id)->paginate(10);
        }

        // Get total count for display
        $totalCount = $clearances->total();

        // Get all clearance types for filter dropdown
        $clearanceTypes = ClearanceType::orderBy('name')->get();

        return view('livewire.clearance.list', [
            'clearances' => $clearances,
            'clearanceTypes' => $clearanceTypes,
            'totalCount' => $totalCount,
        ]); 
    }
}
