<?php

namespace App\Livewire\Forms;

use App\Models\Vehicle;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class VehicleForm extends Form
{
    public ?Vehicle $vehicle = null;

    public string $name = '';
    public string $description = '';
    public string $status = '';
    public string $calendar_color = '';

    /**
     * Set the vehicle data into the form.
     *
     * @param Vehicle|null $vehicle
     */
    public function setVehicle(?Vehicle $vehicle = null): void
    {
            $this->vehicle = $vehicle;
            $this->name = $vehicle->name;
            $this->description = $vehicle->description;
            $this->status = $vehicle->status;
            $this->calendar_color = $vehicle->calendar_color ?? '#ffffff';
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'description' => ['required'],
            'status' => ['required'],
            'calendar_color' => ['nullable', 'string', 'regex:/^#[a-fA-F0-9]{6}$/'],
        ];
    }

    /**
     * @return string[]
     */
    public function validationAttributes(): array
    {
        return [
            'name' => 'name',
            'description' => 'description',
            'status' => 'status',
            'calendar_color' => 'calendar_color',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();

        if (!$this->vehicle) {
            Vehicle::create($this->only(['name', 'description', 'status', 'calendar_color']));
        } else {
            $this->vehicle->update($this->only(['name', 'description', 'status', 'calendar_color']));
        }

        $this->reset();
    }
}
