<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\ComplaintForm;
use App\Models\Complaint;
use App\Models\ComplaintCategory;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class ComplaintModal extends ModalComponent
{
    public ?Complaint $complaint = null;
    public ComplaintForm $form;

    /**
     * @param Complaint|null $complaint
     */
    public function mount(Complaint $complaint = null): void
    {
        if ($complaint && $complaint->exists) {
            $this->form->setComplaint($complaint);
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

        if (!auth()->user()) {
            session()->flash('status', 'Complaint successfully submitted.');
            $this->redirectRoute('home');
        }
    }

    /**
     * @return View
     */
    public function render() : View
    {
        return view('livewire.forms.complaint-form',[
            'complaintCategories' => ComplaintCategory::all(),
        ]);
    }
}
