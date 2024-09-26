<?php

namespace App\Livewire;

use App\Models\Announcement as AnnouncementModel;
use App\Models\Complaint as ComplaintModel;
use App\Models\Photo; // Import the Photo model
use Livewire\Component;

class Welcome extends Component
{
    public function render()
    {
        return view('livewire.welcome.landing', [
            'pinned_announcement' => AnnouncementModel::where('is_pinned', 1)->orderByDesc('created_at')->first(),
            'announcements' => AnnouncementModel::where('is_pinned', 0)->orderByDesc('created_at')->paginate(3),
            'latest_photo' => Photo::orderByDesc('created_at')->first(), // Get the latest photo
        ]);
    }
}
