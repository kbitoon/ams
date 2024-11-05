<?php

namespace App\Livewire\Modals;

use App\Models\VehicleSchedule;
use App\Models\Vehicle;
use App\Models\Driver;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Database\Eloquent\Collection;
use App\Livewire\Forms\VehicleScheduleForm;
use Carbon\Carbon;

class VehicleScheduleModal extends ModalComponent
{
    public ?VehicleSchedule $vehicleSchedule = null;
    public VehicleScheduleForm $form;
    public Collection $vehicles;
    public Collection $drivers;

    public function mount(VehicleSchedule $vehicleSchedule = null): void
    {
        if ($vehicleSchedule && $vehicleSchedule->exists) {
            $this->form->setVehicleSchedule($vehicleSchedule);
        }

        $this->vehicles = Vehicle::all();
        $this->drivers = Driver::all();
    }

    public function save(): void
    {
        $this->form->save();
        $this->closeModal();
        $this->dispatch('refreshList');
    }

    public function render(): View
    {
        return view('livewire.forms.vehicle-schedule-form', [
            'vehicles' => $this->vehicles,
            'drivers' => $this->drivers,
        ]);
    }
}
