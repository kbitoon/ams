<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\ReliefTypeForm;
use App\Models\ReliefType;
use LivewireUI\Modal\ModalComponent;

class ReliefTypeModal extends ModalComponent
{
    public ?ReliefType $reliefType = null;
    public ReliefTypeForm $form;

    public function mount(ReliefType $type = null): void
    {
        if ($type && $type->exists) {
            $this->reliefType = $type;
            $this->form->setReliefType($type);
        }
    }

    public function save(): void
    {
        $this->form->save();
        $this->closeModal();
        $this->dispatch('refresh-list');
    }

    public function render()
    {
        return view('livewire.modals.relief-type-modal');
    }
}

