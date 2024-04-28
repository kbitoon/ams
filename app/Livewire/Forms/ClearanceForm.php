<?php

namespace App\Livewire\Forms;

use App\Models\Clearance;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class ClearanceForm extends Form
{
    public ?Clearance $clearance = null;
    public string $name = '';
    public string $purpose = '';

    /**
     * @param Clearance|null $clearance
     */
    public function setClearance(?Clearance $clearance = null): void
    {
        $this->clearance = $clearance;
        $this->name = $clearance->name;
        $this->purpose = $clearance->purpose;
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'purpose' => ['required'],
        ];
    }

    /**
     * @return string[]
     */
    public function validationAttributes(): array
    {
        return [
            'name' => 'name',
            'purpose' => 'purpose',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();
        if (!$this->clearance) {
            Clearance::create($this->only(['name', 'purpose']));
        } else {
            $this->clearance->update($this->only(['name', 'purpose']));
        }
        $this->reset();
    }

}
