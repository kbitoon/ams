<?php

namespace App\Livewire;

use App\Models\ReliefOperation as ReliefOperationModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ReliefOperationView extends Component
{
    public int $operationId;
    public ?ReliefOperationModel $operation = null;

    public function mount($operation)
    {
        $this->operationId = is_numeric($operation) ? $operation : $operation->id;
        $this->loadOperation();
    }

    public function loadOperation()
    {
        $this->operation = ReliefOperationModel::with([
            'creator',
            'provider',
            'reliefItems.reliefType',
            'reliefItems.provider',
            'distributions.user',
            'distributions.family.headOfFamily',
            'distributions.reliefItem.reliefType',
            'distributions.distributor',
        ])->findOrFail($this->operationId);
    }

    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        return view('livewire.relief-operation.view', [
            'operation' => $this->operation,
        ]);
    }
}

