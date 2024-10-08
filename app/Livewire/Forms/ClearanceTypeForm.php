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
    public string $requirement = '';

    /**
     * @param ClearanceType|null $clearanceType
     */
    public function setClearanceType(?ClearanceType $clearanceType = null): void
    {
        $this->clearanceType = $clearanceType;
        $this->name = $clearanceType->name;
        $this->amount = $clearanceType->amount;
        $this->requirement = empty($clearanceType->requirement) ? '' : $clearanceType->requirement;
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'amount' => ['required'],
            'requirement' => ['nullable'],
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
            'requirement' => 'requirement',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();
        if (!$this->clearanceType) {
            ClearanceType::create($this->only(['name', 'amount','requirement']));
        } else {
            $this->clearanceType->update($this->only(['name', 'amount','requirement']));
        }
        $this->reset();
    }
}
