<?php

namespace App\Livewire\Forms;

use App\Models\DisasterResource;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class DisasterResourceForm extends Form
{
    public ?DisasterResource $resource = null;

    public string $disaster_event_id = '';
    public string $resource_type = 'equipment';
    public string $name = '';
    public string $description = '';
    public string $quantity = '1';
    public string $unit = '';
    public string $location = '';
    public string $status = 'available';
    public string $assigned_to = '';
    public string $assigned_team_id = '';
    public string $notes = '';

    public function setResource(?DisasterResource $resource = null): void
    {
        $this->resource = $resource;
        $this->disaster_event_id = $resource->disaster_event_id ?? '';
        $this->resource_type = $resource->resource_type ?? 'equipment';
        $this->name = $resource->name ?? '';
        $this->description = $resource->description ?? '';
        $this->quantity = $resource->quantity ?? '1';
        $this->unit = $resource->unit ?? '';
        $this->location = $resource->location ?? '';
        $this->status = $resource->status ?? 'available';
        $this->assigned_to = $resource->assigned_to ?? '';
        $this->assigned_team_id = $resource->assigned_team_id ?? '';
        $this->notes = $resource->notes ?? '';
    }

    public function rules(): array
    {
        return [
            'disaster_event_id' => ['nullable', 'exists:disaster_events,id'],
            'resource_type' => ['required', 'in:equipment,vehicle,facility,personnel,supplies'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'quantity' => ['required', 'numeric', 'min:0.01'],
            'unit' => ['nullable', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:available,in_use,damaged,unavailable'],
            'assigned_to' => ['nullable', 'exists:users,id'],
            'assigned_team_id' => ['nullable', 'exists:disaster_response_teams,id'],
            'notes' => ['nullable', 'string'],
        ];
    }

    protected function cleanFields(): void
    {
        $this->disaster_event_id = $this->disaster_event_id === '' ? null : $this->disaster_event_id;
        $this->assigned_to = $this->assigned_to === '' ? null : $this->assigned_to;
        $this->assigned_team_id = $this->assigned_team_id === '' ? null : $this->assigned_team_id;
        $this->notes = $this->notes === '' ? null : $this->notes;
    }

    public function save(): void
    {
        $this->cleanFields();
        $this->validate();

        if (!$this->resource) {
            DisasterResource::create($this->only([
                'disaster_event_id',
                'resource_type',
                'name',
                'description',
                'quantity',
                'unit',
                'location',
                'status',
                'assigned_to',
                'assigned_team_id',
                'notes',
            ]));
        } else {
            $this->resource->update($this->only([
                'disaster_event_id',
                'resource_type',
                'name',
                'description',
                'quantity',
                'unit',
                'location',
                'status',
                'assigned_to',
                'assigned_team_id',
                'notes',
            ]));
        }

        $this->reset();
    }
}

