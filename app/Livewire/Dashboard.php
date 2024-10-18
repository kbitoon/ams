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

        $total_out_of_school_youth = UserStatisticsModel::where('group', 'Out of School Youth')->value('total');
        $total_malnourished_children = UserStatisticsModel::where('group', 'Malnourished Children')->value('total');
        $total_senior_citizens = UserStatisticsModel::where('group', 'Senior Citizen')->value('total');
        $total_pregnant = UserStatisticsModel::where('group', 'Pregnant')->value('total');
        $total_single_parents = UserStatisticsModel::where('group', 'Single Parent')->value('total');

        $pending_clearances = ClearanceModel::where('status', 'Pending')->count();

        $pending_complaints = ComplaintModel::where('status', 'Pending')->count();


        return view('livewire.dashboard.landing', [
            'pinned_announcement' => AnnouncementModel::where('is_pinned', 1)->orderByDesc('created_at')->first(),
            'announcements' => AnnouncementModel::where('is_pinned', 0)->orderByDesc('created_at')->paginate(3),
            'complaints' => ComplaintModel::where('is_pinned', 0)->where('user_id', auth()->user()->id)->orderByDesc('created_at')->paginate(5),
            'total_users' => $total_users,
            'total_out_of_school_youth' => ['total' => $total_out_of_school_youth, 'group' => 'Out of School Youth'],
            'total_malnourished_children' => ['total' => $total_malnourished_children, 'group' => 'Malnourished Children'],
            'total_senior_citizens' => ['total' => $total_senior_citizens, 'group' => 'Senior Citizen'],
            'total_pregnant' => ['total' => $total_pregnant, 'group' => 'Pregnant'],
            'total_single_parents' => ['total' => $total_single_parents, 'group' => 'Single Parent'],
            'pending_clearances' => $pending_clearances,
            'pending_complaints' => $pending_complaints,
        ]);
    }
}
