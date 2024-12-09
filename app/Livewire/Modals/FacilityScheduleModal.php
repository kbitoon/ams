<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\FacilityScheduleForm;
use App\Models\FacilitySchedule;
use App\Models\Facility;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class FacilityScheduleModal extends ModalComponent
{
    public ?FacilitySchedule $facilitySchedule = null;
    public FacilityScheduleForm $form;

    public function mount(FacilitySchedule $facilitySchedule = null): void
    {
        if ($facilitySchedule && $facilitySchedule->exists) {
            $this->form->setFacilitySchedule($facilitySchedule);
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
        return view('livewire.forms.facility-schedule-form', [
            'facilities' => Facility::all(),
        ]);
    }
}
