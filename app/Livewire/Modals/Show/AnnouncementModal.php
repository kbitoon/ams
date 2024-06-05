<?php

namespace App\Livewire\Modals\Show;

use App\Models\Announcement;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;

class AnnouncementModal extends ModalComponent
{
    public ?Announcement $announcement = null;

    /**
     * @param Announcement|null $announcement
     */
    public function mount(Announcement $announcement = null): void
    {
        if ($announcement && $announcement->exists) {
            $this->announcement = $announcement;
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function render()
    {
        return view('livewire.announcement.view', [
            'announcement' => $this->announcement,
        ]);
    }
}
