<?php

namespace App\Livewire\Modals\Show;

use App\Models\Information;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;

class InformationModal extends ModalComponent
{
    public ?Information $information = null;

    /**
     * @param Information|null $information
     */
    public function mount(Information $information = null): void
    {
        if ($information && $information->exists) {
            $this->information = $information;
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function render()
    {
        return view('livewire.information.view', [
            'information' => $this->information,
        ]);
    }
}
