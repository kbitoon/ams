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

        // Check for duplicate schedules for the same vehicle, excluding the current schedule if editing
        $overlappingSchedules = VehicleSchedule::where('vehicle_id', $this->vehicle_id)
            ->where(function ($query) {
                $query->whereBetween('start', [$this->start, $this->end])
                    ->orWhereBetween('end', [$this->start, $this->end])
                    ->orWhere(function ($query) {
                        $query->where('start', '<=', $this->start)
                                ->where('end', '>=', $this->end);
                    });
            })
            ->where('status', '!=', 'Done') // Exclude completed schedules
            ->when($this->vehicleSchedule, function ($query) {
                $query->where('id', '!=', $this->vehicleSchedule->id); // Exclude the current schedule
            })
            ->exists();

        if ($overlappingSchedules) {
            throw ValidationException::withMessages([
                'vehicle_id' => ['The selected vehicle has an overlapping schedule.'],
            ]);
        }

        if (!$this->vehicleSchedule) {
            VehicleSchedule::create($this->only(['destination', 'start', 'end', 'vehicle_id', 'driver_id', 'status']));
        } else {
            $this->vehicleSchedule->update($this->only(['destination', 'start', 'end', 'vehicle_id', 'driver_id', 'status']));
        }

        $this->reset();
    }
}
