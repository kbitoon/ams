<?php

namespace App\Livewire;

use App\Models\Announcement as AnnouncementModel;
use App\Models\Complaint as ComplaintModel;
use App\Models\User as UserModel;
use App\Models\UserStatistics as UserStatisticsModel;
use App\Models\Clearance as ClearanceModel;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $total_users = UserModel::whereHas('roles', function($query) {
            $query->where('name', 'user');
        })->count();

        $total_out_of_school_youth = UserStatisticsModel::where('group', 'Out of School Youth')->count();
        $total_malnourished_children = UserStatisticsModel::where('group', 'Malnourished')->count();
        $total_senior_citizens = UserStatisticsModel::where('group', 'Senior Citizen')->count();
        $total_pregnant = UserStatisticsModel::where('group', 'Pregnant')->count();
        $total_single_parents = UserStatisticsModel::where('group', 'Single Parent')->count();

        $pending_clearances = ClearanceModel::where('status', 'Pending')->count();

        $pending_complaints = ComplaintModel::where('status', 'Pending')->count();


        return view('livewire.dashboard.landing', [
            'pinned_announcement' => AnnouncementModel::where('is_pinned', 1)->orderByDesc('created_at')->first(),
            'announcements' => AnnouncementModel::where('is_pinned', 0)->orderByDesc('created_at')->paginate(3),
            'complaints' => ComplaintModel::where('is_pinned', 0)->where('user_id', auth()->user()->id)->orderByDesc('created_at')->paginate(5),
            'total_users' => $total_users,
            'total_out_of_school_youth' => $total_out_of_school_youth,
            'total_malnourished_children' => $total_malnourished_children,
            'total_senior_citizens' => $total_senior_citizens,
            'total_pregnant' => $total_pregnant,
            'total_single_parents' => $total_single_parents,
            'pending_clearances' => $pending_clearances,
            'pending_complaints' => $pending_complaints,
        ]);
    }
}
