<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\ComplaineeForm;
use App\Models\Complainee;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class ComplaineeModal extends ModalComponent
{
    public ?Complainee $complainee = null;
    public ComplaineeForm $form;

    public function mount(Complainee $complainee = null): void
    {
        if ($complainee && $complainee->exists) {
            $this->form->setBlotter($complainee);
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
        return view('livewire.forms.blotter-form', [
            'complainees' => Complainee::all(),
        ]);
    }
}