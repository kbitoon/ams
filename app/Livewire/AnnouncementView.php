<?php

namespace App\Livewire;

use App\Models\Announcement;
use Livewire\Component;

class AnnouncementView extends Component
{
    public $announcement;

    public function mount($id)
    {
        $this->announcement = Announcement::with(['category', 'user', 'assets'])->findOrFail($id);
    }

    public function render()
    {
        return view('livewire.announcement.full-view', [
            'announcement' => $this->announcement,
        ]);
    }
}

