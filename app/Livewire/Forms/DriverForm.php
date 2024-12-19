<?php

namespace App\Livewire\Forms;

use App\Models\Driver;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class DriverForm extends Form
{
    public ?Driver $driver = null;

    public string $name = '';
    public string $contact_number = '';
    public string $status = '';

    /**
     * @param Driver|null $driver
     */
    public function setDriver(?Driver $driver = null): void
    {
        $this->driver = $driver;
        $this->name = $driver->name;
        $this->contact_number = empty($driver->contact_number) ? '' : $driver->contact_number;
        $this->status = $driver->status;
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'contact_number' => ['nullable'],
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
            'contact_number' => 'contact_number',
            'status' => 'status',
        ]; 
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();
        if (!$this->driver) {
            Driver::create($this->only(['name', 'contact_number', 'status']));
        } else {
            $this->driver->update($this->only(['name','contact_number', 'status']));
        }
        $this->reset();
    } 
}
