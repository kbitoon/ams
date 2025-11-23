<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\ReliefItemForm;
use App\Models\ReliefItem;
use App\Models\ReliefOperation;
use App\Models\ReliefType;
use App\Models\ReliefProvider;
use LivewireUI\Modal\ModalComponent;

class ReliefItemModal extends ModalComponent
{
    public ?ReliefItem $reliefItem = null;
    public ?ReliefOperation $operation = null;
    public ReliefItemForm $form;

    public function mount(ReliefItem $item = null, ReliefOperation $operation = null): void
    {
        if ($item && $item->exists) {
            $this->reliefItem = $item;
            $this->form->setReliefItem($item);
        } elseif ($operation && $operation->exists) {
            $this->operation = $operation;
            $this->form->relief_operation_id = $operation->id;
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
        return view('livewire.modals.relief-item-modal', [
            'operations' => ReliefOperation::orderBy('title')->get(),
            'types' => ReliefType::orderBy('name')->get(),
            'providers' => ReliefProvider::where('is_active', true)->orderBy('name')->get(),
        ]);
    }
}

