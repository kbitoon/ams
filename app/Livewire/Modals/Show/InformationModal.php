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
            // Load relationships if not already loaded
            if (!$information->relationLoaded('category')) {
                $information->load('category');
            }
            if (!$information->relationLoaded('user')) {
                $information->load('user');
            }
            if (!$information->relationLoaded('assets')) {
                $information->load('assets');
            }
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
