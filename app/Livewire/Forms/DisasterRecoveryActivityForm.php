<?php

namespace App\Livewire\Forms;

use App\Models\DisasterRecoveryActivity;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class DisasterRecoveryActivityForm extends Form
{
    public ?DisasterRecoveryActivity $activity = null;

    public string $disaster_event_id = '';
    public string $activity_type = 'other';
    public string $title = '';
    public string $description = '';
    public string $location = '';
    public string $responsible_person_id = '';
    public string $assigned_team_id = '';
    public string $start_date = '';
    public string $target_completion_date = '';
    public string $actual_completion_date = '';
    public string $status = 'planned';
    public string $budget = '';
    public string $actual_cost = '';
    public string $progress_percentage = '0';
    public string $notes = '';

    public function setActivity(?DisasterRecoveryActivity $activity = null): void
    {
        $this->activity = $activity;
        $this->disaster_event_id = $activity->disaster_event_id ?? '';
        $this->activity_type = $activity->activity_type ?? 'other';
        $this->title = $activity->title ?? '';
        $this->description = $activity->description ?? '';
        $this->location = $activity->location ?? '';
        $this->responsible_person_id = $activity->responsible_person_id ?? '';
        $this->assigned_team_id = $activity->assigned_team_id ?? '';
        $this->start_date = $activity->start_date ? $activity->start_date->format('Y-m-d') : '';
        $this->target_completion_date = $activity->target_completion_date ? $activity->target_completion_date->format('Y-m-d') : '';
        $this->actual_completion_date = $activity->actual_completion_date ? $activity->actual_completion_date->format('Y-m-d') : '';
        $this->status = $activity->status ?? 'planned';
        $this->budget = $activity->budget ?? '';
        $this->actual_cost = $activity->actual_cost ?? '';
        $this->progress_percentage = $activity->progress_percentage ?? '0';
        $this->notes = $activity->notes ?? '';
    }

    public function rules(): array
    {
        return [
            'disaster_event_id' => ['required', 'exists:disaster_events,id'],
            'activity_type' => ['required', 'in:cleanup,reconstruction,rehabilitation,assistance_distribution,infrastructure_repair,other'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'responsible_person_id' => ['nullable', 'exists:users,id'],
            'assigned_team_id' => ['nullable', 'exists:disaster_response_teams,id'],
            'start_date' => ['required', 'date'],
            'target_completion_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'actual_completion_date' => ['nullable', 'date'],
            'status' => ['required', 'in:planned,in_progress,completed,cancelled'],
            'budget' => ['nullable', 'numeric', 'min:0'],
            'actual_cost' => ['nullable', 'numeric', 'min:0'],
            'progress_percentage' => ['required', 'integer', 'min:0', 'max:100'],
            'notes' => ['nullable', 'string'],
        ];
    }

    protected function cleanFields(): void
    {
        $this->responsible_person_id = $this->responsible_person_id === '' ? null : $this->responsible_person_id;
        $this->assigned_team_id = $this->assigned_team_id === '' ? null : $this->assigned_team_id;
        $this->target_completion_date = $this->target_completion_date === '' ? null : $this->target_completion_date;
        $this->actual_completion_date = $this->actual_completion_date === '' ? null : $this->actual_completion_date;
        $this->budget = $this->budget === '' ? null : ($this->budget ? (float) $this->budget : null);
        $this->actual_cost = $this->actual_cost === '' ? null : ($this->actual_cost ? (float) $this->actual_cost : null);
        $this->notes = $this->notes === '' ? null : $this->notes;
    }

    public function save(): void
    {
        $this->cleanFields();
        $this->validate();

        if (!$this->activity) {
            DisasterRecoveryActivity::create($this->only([
                'disaster_event_id',
                'activity_type',
                'title',
                'description',
                'location',
                'responsible_person_id',
                'assigned_team_id',
                'start_date',
                'target_completion_date',
                'actual_completion_date',
                'status',
                'budget',
                'actual_cost',
                'progress_percentage',
                'notes',
            ]));
        } else {
            $this->activity->update($this->only([
                'disaster_event_id',
                'activity_type',
                'title',
                'description',
                'location',
                'responsible_person_id',
                'assigned_team_id',
                'start_date',
                'target_completion_date',
                'actual_completion_date',
                'status',
                'budget',
                'actual_cost',
                'progress_percentage',
                'notes',
            ]));
        }

        $this->reset();
    }
}

