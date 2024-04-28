<?php

namespace App\Livewire;

use App\Models\Clearance as ClearanceModel;
use Livewire\Attributes\On;
use Livewire\Component;

class Clearance extends Component
{
    #[On('refresh-list')]
    public function refresh() {}

    public function render()
    {
        return view('livewire.clearance.list', [
            'clearances' => ClearanceModel::all(),
        ]);
    }
}
