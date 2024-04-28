<?php

namespace App\Livewire;

use App\Models\ClearanceType as ClearanceTypeModel;
use Livewire\Attributes\On;
use Livewire\Component;

class ClearanceType extends Component
{

    #[On('refresh-list')]
    public function refresh() {}

    public function render()
    {
        return view('livewire.clearance.type', [
            'clearanceTypes' => ClearanceTypeModel::all(),
        ]);
    }
}
