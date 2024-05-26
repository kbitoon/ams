<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\ComplaintCategoryForm;
use App\Models\ComplaintCategory;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class ComplaintCategoryModal extends ModalComponent
{
    public ?ComplaintCategory $complaintCategory = null;
    public ComplaintCategoryForm $form;

    /**
     * @param ComplaintCategory|null $complaintCategory
     */
    public function mount(ComplaintCategory $complaintCategory = null): void
    {
        if ($complaintCategory && $complaintCategory->exists) {
            $this->form->setComplaintCategory($complaintCategory);
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
        return view('livewire.forms.complaint-category-form');
    }
}
