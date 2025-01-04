<?php

namespace App\Livewire\Modals\Show;

use App\Models\VehicleSchedule;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;

class VehicleScheduleModal extends ModalComponent
{
    public ?VehicleSchedule $vehicleSchedule = null;

    /**
     * @param VehicleSchedule|null $vehicle
     */
    public function mount(VehicleSchedule $vehicleSchedule = null): void
    {
        if ($vehicleSchedule && $vehicleSchedule->exists) {
            $this->vehicleSchedule = $vehicleSchedule;
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function render()
    {
        return view('livewire.vehicle.schedule-view', [
            'vehicleSchedule' => $this->vehicleSchedule,
        ]);
    }
}
