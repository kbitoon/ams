<?php

namespace App\Livewire\Modals\Show;

use App\Models\Clearance;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;

class ClearanceModal extends ModalComponent
{
    public ?Clearance $clearance = null;

    /**
     * @param Clearance|null $clearance
     */
    public function mount(Clearance $clearance = null): void
    {
        if ($clearance && $clearance->exists) {
            $this->clearance = $clearance;
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function render()
    {
        return view('livewire.clearance.view', [
            'clearance' => $this->clearance,
        ]);
    }
}