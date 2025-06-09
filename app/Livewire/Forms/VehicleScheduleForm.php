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
    public string $name = '';
    public string $vehicle_id = '';
    public ?string $driver_id = null; 
    public string $status = '';
    public string $is_approved = '';

    public string $details = '';

    /**
     * @param VehicleSchedule|null $vehicle
     */
    public function setVehicleSchedule(?VehicleSchedule $vehicleSchedule = null): void
    {
        $this->vehicleSchedule = $vehicleSchedule;
        $this->destination = $vehicleSchedule->destination;
        $this->start = $vehicleSchedule->start;
        $this->end = $vehicleSchedule->end;
        $this->name = empty($vehicleSchedule->name) ? : $vehicleSchedule->name;
        $this->details = $vehicleSchedule->details ?? '';
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
            'name' => ['required'],
            'vehicle_id' => ['required'],
            'details' => ['nullable', 'string'],
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
            'name' => 'name',
            'details' => 'details',
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

        // Determine the role of the user
        $userRole = auth()->user()->getRoleNames()->first();
        $isAdminRole = in_array($userRole, ['administrator', 'superadmin', 'support']);

        // Automatically set is_approved
        $this->is_approved = $isAdminRole ? '1' : '0';

        $data = $this->only(['destination', 'start', 'end', 'name','details', 'vehicle_id', 'driver_id', 'status', 'is_approved']);
        $data['user_id'] = auth()->user()->id;

        if (!$this->vehicleSchedule) {
            VehicleSchedule::create($data);
        } else {
            $this->vehicleSchedule->update($data);
        }

        $this->reset();
    }
}
