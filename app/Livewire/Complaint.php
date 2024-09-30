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
use Carbon\Carbon;
class Complaint extends Component
{
    use WithPagination, WithoutUrlPagination;

    public string $search = '';

    protected $updatesQueryString = ['search',];

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
    public function getTimeAgo($complaintDate)
    {
        $complaintDate = Carbon::parse($complaintDate);
        $now = Carbon::now();
    
        $diffInSeconds = $complaintDate->diffInSeconds($now);

        if ($diffInSeconds < 3600) {
            $minutes = floor($complaintDate->diffInMinutes($now));
            return $minutes . ' minute' . ($minutes > 1 ? 's' : '') . ' ago';
        }
        if ($diffInSeconds < 86400) {
            $hours = floor($complaintDate->diffInHours($now));
            return $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ago';
        }
        $days = floor($complaintDate->diffInDays($now));
        return $days . ' day' . ($days > 1 ? 's' : '') . ' ago';
    }    

    public function searchComplaint()
    {
        $this->resetPage(); // Reset pagination to the first page
    }

    public function render(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        // Build the query
        $query = ComplaintModel::query();

        // Apply search filter
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('title', 'like', '%' . $this->search . '%');
        }

        // If the user is a superadmin/administrator/support, show all complaints, else filter by user
        if (auth()->user()->hasRole('superadmin|administrator|support')) {
            $complaints = $query->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $complaints = $query->where('user_id', auth()->user()->id)
                                ->orderBy('created_at', 'desc')
                                ->paginate(10);
        }

        return view('livewire.complaint.list', [
            'complaints' => $complaints,
        ]);
    }
}
