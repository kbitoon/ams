<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\AnnouncementForm;
use App\Models\Announcement;
use App\Models\AnnouncementCategory;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class AnnouncementModal extends ModalComponent
{
    public ?Announcement $announcement = null;
    public AnnouncementForm $form;

    public function mount(Announcement $announcement = null): void
    {
        if ($announcement && $announcement->exists) {
            $this->form->setAnnouncement($announcement);
        }
    }

    public function save(): void
    {
        $this->form->save();
        $this->closeModal();
        $this->dispatch('refresh-list');
    }

    public function render(): View
    {
        return view('livewire.forms.announcement-form', [
            'announcementCategories' => AnnouncementCategory::all(),
        ]);
    }
}
