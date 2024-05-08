<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\AnnouncementCategoryForm;
use App\Models\AnnouncementCategory;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class AnnouncementCategoryModal extends ModalComponent
{
    public ?AnnouncementCategory $announcementCategory = null;
    public AnnouncementCategoryForm $form;

    /**
     * @param AnnouncementCategory|null $announcementCategory
     */
    public function mount(AnnouncementCategory $announcementCategory = null): void
    {
        if ($announcementCategory && $announcementCategory->exists) {
            $this->form->setAnnouncementCategory($announcementCategory);
        }
    }

    /**
     * Save clearance
     */
    public function save(): void
    {
        $this->form->save();
        $this->closeModal();
        $this->dispatch('refresh-list');
    }

    /**
     * @return View
     */
    public function render() : View
    {
        return view('livewire.forms.announcement-category-form');
    }
}
