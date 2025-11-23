<?php

namespace App\Livewire\Forms;

use App\Models\DisasterAlert;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class DisasterAlertForm extends Form
{
    public ?DisasterAlert $disasterAlert = null;

    public string $disaster_event_id = '';
    public string $alert_type = 'advisory';
    public string $severity = 'medium';
    public string $title = '';
    public string $message = '';
    public array $affected_areas = [];
    public string $issued_at = '';
    public string $issued_time = '';
    public string $expires_at = '';
    public string $expires_time = '';
    public bool $is_active = true;

    public function setDisasterAlert(?DisasterAlert $disasterAlert = null): void
    {
        $this->disasterAlert = $disasterAlert;
        $this->disaster_event_id = $disasterAlert->disaster_event_id ?? '';
        $this->alert_type = $disasterAlert->alert_type ?? 'advisory';
        $this->severity = $disasterAlert->severity ?? 'medium';
        $this->title = $disasterAlert->title ?? '';
        $this->message = $disasterAlert->message ?? '';
        $this->affected_areas = $disasterAlert->affected_areas ?? [];
        $this->issued_at = $disasterAlert->issued_at ? $disasterAlert->issued_at->format('Y-m-d') : now()->format('Y-m-d');
        $this->issued_time = $disasterAlert->issued_at ? $disasterAlert->issued_at->format('H:i') : now()->format('H:i');
        $this->expires_at = $disasterAlert->expires_at ? $disasterAlert->expires_at->format('Y-m-d') : '';
        $this->expires_time = $disasterAlert->expires_at ? $disasterAlert->expires_at->format('H:i') : '';
        $this->is_active = $disasterAlert->is_active ?? true;
    }

    public function rules(): array
    {
        return [
            'disaster_event_id' => ['nullable', 'exists:disaster_events,id'],
            'alert_type' => ['required', 'in:warning,watch,advisory,evacuation'],
            'severity' => ['required', 'in:low,medium,high,critical'],
            'title' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
            'affected_areas' => ['nullable', 'array'],
            'issued_at' => ['required', 'date'],
            'issued_time' => ['required'],
            'expires_at' => ['nullable', 'date', 'after:issued_at'],
            'expires_time' => ['nullable'],
            'is_active' => ['boolean'],
        ];
    }

    public function save(): void
    {
        $this->validate();

        $data = $this->only([
            'disaster_event_id',
            'alert_type',
            'severity',
            'title',
            'message',
            'affected_areas',
            'is_active',
        ]);

        // Combine date and time
        $data['issued_at'] = $this->issued_at . ' ' . $this->issued_time . ':00';
        if ($this->expires_at && $this->expires_time) {
            $data['expires_at'] = $this->expires_at . ' ' . $this->expires_time . ':00';
        } else {
            $data['expires_at'] = null;
        }

        // Convert empty strings to null
        $data['disaster_event_id'] = $data['disaster_event_id'] === '' ? null : $data['disaster_event_id'];

        if (!$this->disasterAlert) {
            $data['issued_by'] = auth()->id();
            DisasterAlert::create($data);
        } else {
            $this->disasterAlert->update($data);
        }

        $this->reset();
    }
}

