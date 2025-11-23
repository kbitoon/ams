<?php

namespace App\Livewire\Forms;

use App\Models\EvacuationCenter;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class EvacuationCenterForm extends Form
{
    public ?EvacuationCenter $evacuationCenter = null;

    public string $name = '';
    public string $address = '';
    public string $latitude = '';
    public string $longitude = '';
    public string $capacity = '';
    public array $facilities = [];
    public string $contact_person_id = '';
    public string $contact_number = '';
    public bool $is_active = true;

    public function setEvacuationCenter(?EvacuationCenter $evacuationCenter = null): void
    {
        $this->evacuationCenter = $evacuationCenter;
        $this->name = $evacuationCenter->name ?? '';
        $this->address = $evacuationCenter->address ?? '';
        $this->latitude = $evacuationCenter->latitude ?? '';
        $this->longitude = $evacuationCenter->longitude ?? '';
        $this->capacity = $evacuationCenter->capacity ?? '';
        $this->facilities = $evacuationCenter->facilities ?? [];
        $this->contact_person_id = $evacuationCenter->contact_person_id ?? '';
        $this->contact_number = $evacuationCenter->contact_number ?? '';
        $this->is_active = $evacuationCenter->is_active ?? true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'capacity' => ['required', 'integer', 'min:1'],
            'facilities' => ['nullable', 'array'],
            'contact_person_id' => ['nullable', 'exists:users,id'],
            'contact_number' => ['nullable', 'string', 'max:255'],
            'is_active' => ['boolean'],
        ];
    }

    protected function cleanFields(): void
    {
        $this->latitude = $this->latitude === '' ? null : ($this->latitude ? (float) $this->latitude : null);
        $this->longitude = $this->longitude === '' ? null : ($this->longitude ? (float) $this->longitude : null);
        $this->contact_person_id = $this->contact_person_id === '' ? null : $this->contact_person_id;
        $this->contact_number = $this->contact_number === '' ? null : $this->contact_number;
    }

    public function save(): void
    {
        $this->cleanFields();
        $this->validate();

        if (!$this->evacuationCenter) {
            EvacuationCenter::create($this->only([
                'name',
                'address',
                'latitude',
                'longitude',
                'capacity',
                'facilities',
                'contact_person_id',
                'contact_number',
                'is_active',
            ]));
        } else {
            $this->evacuationCenter->update($this->only([
                'name',
                'address',
                'latitude',
                'longitude',
                'capacity',
                'facilities',
                'contact_person_id',
                'contact_number',
                'is_active',
            ]));
        }

        $this->reset();
    }
}

