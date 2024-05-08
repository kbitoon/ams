<?php

namespace App\Livewire;

use App\Models\ClearanceType as ClearanceTypeModel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ClearanceType extends Component
{

    #[On('refresh-list')]
    public function refresh() {}

    /**
     * @return Factory|\Illuminate\Foundation\Application|View|Application
     */
    public function render(): Factory|\Illuminate\Foundation\Application|View|Application
    {
        return view('livewire.clearance.type', [
            'clearanceTypes' => ClearanceTypeModel::all(),
        ]);
    }
}
