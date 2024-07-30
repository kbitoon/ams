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
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();

        if (!$this->vehicle) {
            Vehicle::create($this->only(['name', 'description', 'status']));
        } else {
            $this->vehicle->update($this->only(['name', 'description', 'status']));
        }

        $this->reset();
    }
}
