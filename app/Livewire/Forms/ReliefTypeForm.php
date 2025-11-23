<?php

namespace App\Livewire\Forms;

use App\Models\ReliefType;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class ReliefTypeForm extends Form
{
    public ?ReliefType $reliefType = null;

    public string $name = '';
    public string $unit = '';
    public string $description = '';

    public function setReliefType(?ReliefType $reliefType = null): void
    {
        $this->reliefType = $reliefType;
        $this->name = $reliefType->name ?? '';
        $this->unit = $reliefType->unit ?? '';
        $this->description = $reliefType->description ?? '';
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'unit' => ['nullable', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'name' => 'name',
            'unit' => 'unit',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();

        if (!$this->reliefType) {
            ReliefType::create($this->only(['name', 'unit', 'description']));
        } else {
            $this->reliefType->update($this->only(['name', 'unit', 'description']));
        }

        $this->reset();
    }
}

