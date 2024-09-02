<?php

namespace App\Livewire;

use App\Models\Announcement as AnnouncementModel;
use App\Models\Complaint as ComplaintModel;
use App\Models\User as UserModel;
use App\Models\Clearance as ClearanceModel;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $total_users = UserModel::whereHas('roles', function($query) {
            $query->where('name', 'user');
        })->count();

        $pending_clearances = ClearanceModel::where('status', 'pending')->count();


        return view('livewire.dashboard.landing', [
            'pinned_announcement' => AnnouncementModel::where('is_pinned', 1)->orderByDesc('created_at')->first(),
            'announcements' => AnnouncementModel::where('is_pinned', 0)->orderByDesc('created_at')->paginate(3),
            'complaints' => ComplaintModel::where('is_pinned', 0)->where('user_id', auth()->user()->id)->orderByDesc('created_at')->paginate(5),
            'total_users' => $total_users,
            'pending_clearances' => $pending_clearances,
        ]);
    }
}
