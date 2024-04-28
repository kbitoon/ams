<?php

namespace App\Livewire\Forms;

use App\Models\ClearanceType;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class ClearanceTypeForm extends Form
{
    public ?ClearanceType $clearanceType = null;
    public string $name = '';
    public string $amount = '';

    /**
     * @param ClearanceType|null $clearanceType
     */
    public function setClearanceType(?ClearanceType $clearanceType = null): void
    {
        $this->clearanceType = $clearanceType;
        $this->name = $clearanceType->name;
        $this->amount = $clearanceType->amount;
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'amount' => ['required'],
        ];
    }

    /**
     * @return string[]
     */
    public function validationAttributes(): array
    {
        return [
            'name' => 'name',
            'amount' => 'amount',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();
        if (!$this->clearanceType) {
            ClearanceType::create($this->only(['name', 'amount']));
        } else {
            $this->clearanceType->update($this->only(['name', 'amount']));
        }
        $this->reset();
    }
}
