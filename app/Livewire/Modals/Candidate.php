<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\CandidateForm;
use App\Models\Candidate;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class CandidateModal extends ModalComponent
{
    public ?Candidate $candidate = null;
    public CandidateForm $form;

    /**
     * @param Candidate|null $candidate
     */
    public function mount(Candidate $candidate = null): void
    {
        if ($candidate && $candidate->exists) {
            $this->form->setCandidate($candidate);
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
        return view('livewire.forms.candidate-form');
    }
}
