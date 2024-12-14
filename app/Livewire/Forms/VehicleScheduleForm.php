<?php

namespace App\Livewire\Forms;

use App\Models\VehicleSchedule;
use Illuminate\Validation\ValidationException;
use Livewire\Form;
use Carbon\Carbon;

class VehicleScheduleForm extends Form
{
    public ?VehicleSchedule $vehicleSchedule = null;

    public string $destination = '';
    public string $start = '';
    public string $end = '';
    public string $vehicle_id = '';
    public ?string $driver_id = null; 
    public string $status = '';

    /**
     * @param VehicleSchedule|null $vehicle
     */
    public function setVehicleSchedule(?VehicleSchedule $vehicleSchedule = null): void
    {
        $this->vehicleSchedule = $vehicleSchedule;
        $this->destination = $vehicleSchedule->destination;
        $this->start = $vehicleSchedule->start;
        $this->end = $vehicleSchedule->end;
        $this->vehicle_id = $vehicleSchedule->vehicle_id;
        $this->driver_id = $vehicleSchedule->driver_id;
        $this->status = $vehicleSchedule->status;
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'destination' => ['required'],
            'start' => ['required', 'date', 'after_or_equal:today'],
            'end' => ['required', 'date', 'after:start'],
            'vehicle_id' => ['required'],
            'driver_id' => ['nullable'],
        ];
    }

    /**
     * @return string[]
     */
    public function validationAttributes(): array
    {
        return [
            'destination' => 'destination',
            'start' => 'start',
            'end' => 'end',
            'vehicle_id' => 'vehicle',
            'driver_id' => 'driver',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();

        $this->driver_id = $this->driver_id === '' ? null : $this->driver_id;

        if (!$this->vehicleSchedule) {
            VehicleSchedule::create($this->only(['destination', 'start', 'end', 'vehicle_id', 'driver_id', 'status']));
        } else {
            $this->vehicleSchedule->update($this->only(['destination', 'start', 'end', 'vehicle_id', 'driver_id', 'status']));
        }

        $this->reset();
    }
}
