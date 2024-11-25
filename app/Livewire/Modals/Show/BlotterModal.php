<?php

namespace App\Livewire\Modals\Show;

use App\Models\Blotter;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;

class BlotterModal extends ModalComponent
{
    public ?Blotter $blotter = null;

    /**
     * @param Blotter|null $blotter
     */
    public function mount(Blotter $blotter = null): void
    {
        if ($blotter && $blotter->exists) {
            $this->blotter = $blotter;
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function render()
    {
        return view('livewire.blotter.view', [
            'blotter' => $this->blotter,
        ]);
    }
}
