<?php

namespace App\Livewire;

use App\Models\Clearance as ClearanceModel;
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

    protected $updatesQueryString = ['search',];

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

    public function getDaysAgo($clearanceDate)
    {
        $createdDate = Carbon::parse($clearanceDate);
        $now = Carbon::now();

        return (int) $createdDate->diffInDays($now);
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

        if (auth()->user()->hasRole('superadmin|administrator|support')) {
            $clearances = $query->paginate(10);
        } else {
            $clearances = $query->where('user_id', auth()->user()->id)->paginate(10);
        }

        return view('livewire.clearance.list', [
            'clearances' => $clearances,
        ]); 
    }
}
