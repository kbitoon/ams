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

        $this->filterAvailableOptions();
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['form.start', 'form.end'])) {
            $this->filterAvailableOptions();
        }
    }

    private function filterAvailableOptions()
    {
        $start = Carbon::parse($this->form->start);
        $end = Carbon::parse($this->form->end);

        $overlappingSchedules = VehicleSchedule::where(function ($query) use ($start, $end) {
            $query->where(function ($query) use ($start, $end) {
                $query->whereBetween('start', [$start, $end])
                    ->orWhereBetween('end', [$start, $end])
                    ->orWhere(function ($query) use ($start, $end) {
                        $query->where('start', '<=', $start)
                                ->where('end', '>=', $end);
                    });
            })
            ->where('status', '!=', 'Done');
        })->get();

        // Extract used vehicle and driver IDs
        $usedVehicleIds = $overlappingSchedules->pluck('vehicle_id')->unique();
        $usedDriverIds = $overlappingSchedules->pluck('driver_id')->unique();


        // Filter out used vehicles and drivers
        $this->vehicles = Vehicle::whereNotIn('id', $usedVehicleIds)->get();
        $this->drivers = Driver::whereNotIn('id', $usedDriverIds)->get();
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
