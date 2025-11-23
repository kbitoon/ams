<?php

namespace App\Livewire\Forms;

use App\Models\DisasterEvent;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class DisasterEventForm extends Form
{
    public ?DisasterEvent $disasterEvent = null;

    public string $disaster_type_id = '';
    public string $title = '';
    public string $description = '';
    public string $status = 'draft';
    public string $severity = 'medium';
    public string $start_date = '';
    public string $start_time = '';
    public string $end_date = '';
    public string $end_time = '';
    public string $location = '';
    public string $latitude = '';
    public string $longitude = '';
    public array $affected_areas = [];
    public string $estimated_affected_population = '';

    public function setDisasterEvent(?DisasterEvent $disasterEvent = null): void
    {
        $this->disasterEvent = $disasterEvent;
        $this->disaster_type_id = $disasterEvent->disaster_type_id ?? '';
        $this->title = $disasterEvent->title ?? '';
        $this->description = $disasterEvent->description ?? '';
        $this->status = $disasterEvent->status ?? 'draft';
        $this->severity = $disasterEvent->severity ?? 'medium';
        $this->start_date = $disasterEvent->start_date ? $disasterEvent->start_date->format('Y-m-d') : '';
        $this->start_time = $disasterEvent->start_date ? $disasterEvent->start_date->format('H:i') : '';
        $this->end_date = $disasterEvent->end_date ? $disasterEvent->end_date->format('Y-m-d') : '';
        $this->end_time = $disasterEvent->end_date ? $disasterEvent->end_date->format('H:i') : '';
        $this->location = $disasterEvent->location ?? '';
        $this->latitude = $disasterEvent->latitude ?? '';
        $this->longitude = $disasterEvent->longitude ?? '';
        $this->affected_areas = $disasterEvent->affected_areas ?? [];
        $this->estimated_affected_population = $disasterEvent->estimated_affected_population ?? '';
    }

    public function rules(): array
    {
        return [
            'disaster_type_id' => ['required', 'exists:disaster_types,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:draft,active,resolved,cancelled'],
            'severity' => ['required', 'in:low,medium,high,critical'],
            'start_date' => ['required', 'date'],
            'start_time' => ['required'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'end_time' => ['nullable'],
            'location' => ['nullable', 'string', 'max:255'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'affected_areas' => ['nullable', 'array'],
            'estimated_affected_population' => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function save(): void
    {
        $this->validate();

        $data = $this->only([
            'disaster_type_id',
            'title',
            'description',
            'status',
            'severity',
            'location',
            'latitude',
            'longitude',
            'affected_areas',
            'estimated_affected_population',
        ]);

        // Combine date and time
        $data['start_date'] = $this->start_date . ' ' . $this->start_time . ':00';
        if ($this->end_date && $this->end_time) {
            $data['end_date'] = $this->end_date . ' ' . $this->end_time . ':00';
        } else {
            $data['end_date'] = null;
        }

        // Convert empty strings to null
        $data['latitude'] = $data['latitude'] === '' ? null : ($data['latitude'] ? (float) $data['latitude'] : null);
        $data['longitude'] = $data['longitude'] === '' ? null : ($data['longitude'] ? (float) $data['longitude'] : null);
        $data['estimated_affected_population'] = $data['estimated_affected_population'] === '' ? null : (int) $data['estimated_affected_population'];

        if (!$this->disasterEvent) {
            $data['created_by'] = auth()->id();
            $data['updated_by'] = auth()->id();
            DisasterEvent::create($data);
        } else {
            $data['updated_by'] = auth()->id();
            $this->disasterEvent->update($data);
        }

        $this->reset();
    }
}

