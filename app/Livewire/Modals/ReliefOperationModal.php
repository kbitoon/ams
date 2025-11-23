<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\ReliefOperationForm;
use App\Models\ReliefOperation;
use App\Models\ReliefProvider;
use LivewireUI\Modal\ModalComponent;

class ReliefOperationModal extends ModalComponent
{
    public ?ReliefOperation $reliefOperation = null;
    public ReliefOperationForm $form;

    public function mount(ReliefOperation $operation = null): void
    {
        if ($operation && $operation->exists) {
            $this->reliefOperation = $operation;
            $this->form->setReliefOperation($operation);
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
        return view('livewire.modals.relief-operation-modal', [
            'providers' => ReliefProvider::where('is_active', true)->orderBy('name')->get(),
        ]);
    }
}

