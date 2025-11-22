<?php

namespace App\Livewire;

use App\Models\Announcement as AnnouncementModel;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportPagination\WithoutUrlPagination;
use Livewire\WithPagination;

class Announcement extends Component
{
    use WithPagination, WithoutUrlPagination;

    public string $search = '';

    protected $updatesQueryString = ['search',];

    #[On('refresh-list')]
    public function refresh() {}

    public function pinned_announcement($announcementId)
    {
        $announcement = AnnouncementModel::find($announcementId);
        
        // Toggle the is_pinned status
        $announcement->is_pinned = !$announcement->is_pinned;
        $announcement->save();

        // Optionally trigger an event to refresh the list
        $this->dispatch('announcement-pinned', ['id' => $announcementId]);

        // Refresh component
        $this->refresh();
    }

    public function searchAnnouncement()
    {
        $this->resetPage(); // Reset pagination to the first page
    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function render(): Application|View|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $query = AnnouncementModel::query();

        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        // Order by pinned first, then by date created (newest first)
        $announcements = $query
            ->orderBy('is_pinned', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.announcement.list', [
            'announcements' => $announcements,
        ]);
    }
}
