<?php

namespace App\Livewire\Forms;

use App\Models\Facility;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class FacilityForm extends Form
{
    public ?Facility $facility = null;

    public string $name  = '';
    public string $location = '';
    public string $status = '';
    public string $calendar_color = '';

    /**
     * @param Facility|null $facility
     */
    public function setFacility(?Facility $facility = null): void
    {
        $this->facility = $facility;
        $this->name = $facility->name;
        $this->location = $facility->location;
        $this->status = $facility->status;
        $this->calendar_color = $facility->calendar_color ?? '#ffffff';
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'location' => ['required'],
            'status' => ['required'],
            'calendar_color' => ['nullable'],
        ];
    }

    /**
     * @return string[]
     */
    public function validationAttributes(): array
    {
        return [
            'name' => 'name',
            'location' => 'location',
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
        if (!$this->facility) {
            $facility = Facility::create($this->only(['name','location', 'status', 'calendar_color']));
        } else {
            $this->facility->update($this->only(['name','location', 'status', 'calendar_color']));
        }
        $this->reset();
    }
}
