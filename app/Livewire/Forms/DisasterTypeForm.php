<?php

namespace App\Livewire\Forms;

use App\Models\DisasterType;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class DisasterTypeForm extends Form
{
    public ?DisasterType $disasterType = null;

    public string $name = '';
    public string $description = '';
    public array $severity_levels = [];
    public bool $is_active = true;

    public function setDisasterType(?DisasterType $disasterType = null): void
    {
        $this->disasterType = $disasterType;
        $this->name = $disasterType->name ?? '';
        $this->description = $disasterType->description ?? '';
        $this->severity_levels = $disasterType->severity_levels ?? [];
        $this->is_active = $disasterType->is_active ?? true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'severity_levels' => ['nullable', 'array'],
            'is_active' => ['boolean'],
        ];
    }

    public function save(): void
    {
        $this->validate();

        if (!$this->disasterType) {
            DisasterType::create($this->only([
                'name',
                'description',
                'severity_levels',
                'is_active',
            ]));
        } else {
            $this->disasterType->update($this->only([
                'name',
                'description',
                'severity_levels',
                'is_active',
            ]));
        }

        $this->reset();
    }
}

