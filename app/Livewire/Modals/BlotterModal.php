<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\BlotterForm;
use App\Models\Blotter;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class BlotterModal extends ModalComponent
{
    public ?Blotter $blotter = null;
    public BlotterForm $form;

    public function mount(Blotter $blotter = null): void
    {
        if ($blotter && $blotter->exists) {
            $this->form->setBlotter($blotter);
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
            'blotters' => Blotter::all(),
        ]);
    }
}