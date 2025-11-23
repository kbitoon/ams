<?php

namespace App\Livewire\Modals;

use App\Models\ReliefOperation;
use Livewire\Attributes\On;
use LivewireUI\Modal\ModalComponent;

class ReliefOperationViewModal extends ModalComponent
{
    public ?ReliefOperation $operation = null;

    public static function modalMaxWidth(): string
    {
        return '4xl'; // Increased width (approximately 20% more than default 2xl)
    }

    public function mount(ReliefOperation $operation = null): void
    {
        if ($operation && $operation->exists) {
            $this->loadOperation($operation->id);
        }
    }

    protected function loadOperation($operationId): void
    {
        $this->operation = ReliefOperation::with([
            'creator',
            'provider',
            'reliefItems.reliefType',
            'reliefItems.provider',
            'distributions.user',
            'distributions.family.headOfFamily',
            'distributions.reliefItem.reliefType',
            'distributions.distributor',
        ])->find($operationId);
    }

    #[On('refresh-list')]
    public function refreshOperation(): void
    {
        if ($this->operation && $this->operation->exists) {
            $this->loadOperation($this->operation->id);
        }
    }

    public function render()
    {
        return view('livewire.modals.relief-operation-view-modal');
    }
}

