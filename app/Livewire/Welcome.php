<?php

namespace App\Livewire;

use App\Models\Announcement as AnnouncementModel;
use Livewire\Component;

class Welcome extends Component
{
    public function render()
    {


        return view('livewire.welcome.landing', [
            'pinned_announcement' => AnnouncementModel::where('is_pinned', 1)->first(),
            'announcements' => AnnouncementModel::where('is_pinned', 0)->paginate(3)
        ]);
    }
}
