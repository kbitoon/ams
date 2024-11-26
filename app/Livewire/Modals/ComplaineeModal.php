<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\ComplaineeForm;
use App\Models\Blotter;
use App\Models\Complainee;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class ComplaineeModal extends ModalComponent
{
    public ?Blotter $blotter = null; 
    public ComplaineeForm $form;

    public function mount(Complainee $complainee = null): void
    {
        if ($complainee && $complainee->exists) {
            $this->form->setComplainee($complainee);
        }
    }

    public function save(): void
    {
        $this->form->save();
        if ($this->blotter) {
            $complaineeId = $this->form->complainee ? $this->form->complainee->id : Complainee::latest()->first()->id;
            $this->blotter->update(['complainee_id' => $complaineeId]);
        }
        $this->closeModal();
        $this->dispatch('refresh-list');
    }

    public function render(): View
    {
        return view('livewire.forms.complainee-form', [
            'complainees' => Complainee::all(),
        ]);
    }
}