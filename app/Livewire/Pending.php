<?php

namespace App\Livewire;

use App\Models\Clearance as ClearanceModel;
use App\Models\Complaint as ComplaintModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class Pending extends Component
{
    use WithPagination;

    // Listen for specific events to refresh the component
    protected $listeners = ['refreshPendingClearances' => '$refresh'];

    // Define the render method explicitly
    public function render(): View|Factory|Application
    {
        $clearances = ClearanceModel::where('status', 'pending')
            ->orderBy('date', 'asc')
            ->paginate(10);
        $complaints = ComplaintModel::where('status', 'pending')
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        return view('livewire.pending', [
            'clearances' => $clearances,
            'complaints' => $complaints,
        ]);
    }

    // Method to refresh the component
    public function refreshPending()
    {
        $this->render();
    }
}
