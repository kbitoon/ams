<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\DisasterTypeForm;
use App\Models\DisasterType;
use LivewireUI\Modal\ModalComponent;

class DisasterTypeModal extends ModalComponent
{
    public ?DisasterType $disasterType = null;
    public DisasterTypeForm $form;

    public function mount(DisasterType $type = null): void
    {
        if ($type && $type->exists) {
            $this->disasterType = $type;
            $this->form->setDisasterType($type);
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
        return view('livewire.modals.disaster-type-modal');
    }
}
