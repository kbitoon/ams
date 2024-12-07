<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\FacilityForm;
use App\Models\Facility;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class FacilityModal extends ModalComponent
{
    public ?Facility $facility = null;
    public FacilityForm $form;

    public function mount(Facility $facility = null): void
    {
        if ($facility && $facility->exists) {
            $this->form->setFacility($facility);
        }
    }

    public function save(): void
    {
        $this->form->save();
        $this->closeModal();
        $this->dispatch('refresh-list');
    }

    public function render(): View
    {
        return view('livewire.forms.facility-form', [
            'facilities' => Facility::all(),
        ]);
    }
}
