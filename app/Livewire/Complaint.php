<?php

namespace App\Livewire;

use App\Models\Complaint as ComplaintModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class Complaint extends Component
{
    use WithPagination, WithoutUrlPagination;

    #[On('refresh-list')]
    public function refresh() {}

    public function markAsDone($complaintId)
    {
        $complaint = ComplaintModel::find($complaintId);

        if ($complaint) {
            $complaint->status = 'done';
            $complaint->approved_by = auth()->user()->id;
            $complaint->save();
        }
        
    }
    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function render(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        if (auth()->user()->hasRole('superadmin|admin')) {
            $complaints = ComplaintModel::with('assets')->paginate(10);
        } else {
            $complaints = ComplaintModel::with('assets')->where('user_id', auth()->user()->id)->paginate(10);
        }

        return view('livewire.complaint.list', [
            'complaints' => $complaints,
        ]);
    }
}
