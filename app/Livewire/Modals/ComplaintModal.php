<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\ComplaintForm;
use App\Models\Complaint;
use App\Models\ComplaintCategory;
use Livewire\WithFileUploads;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class ComplaintModal extends ModalComponent
{
    use WithFileUploads;

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

            $latestComplaint = Complaint::orderBy('id', 'desc')->first();
            $nextId = $latestComplaint ? $latestComplaint->id : 1; 
            $base64Id = base64_encode($nextId);
    
            // Set the success message with the base64 reference ID
            session()->flash('status', "Complaint successfully submitted.");
            session()->flash('reference_id', $base64Id);
    
            // Redirect to the home route
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
