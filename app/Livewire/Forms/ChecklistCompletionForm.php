<?php

namespace App\Livewire\Forms;

use App\Models\ChecklistCompletion;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class ChecklistCompletionForm extends Form
{
    public ?ChecklistCompletion $completion = null;

    public string $checklist_id = '';
    public string $disaster_event_id = '';
    public array $completed_items = [];
    public string $notes = '';
    public string $completed_at = '';

    public function setCompletion(?ChecklistCompletion $completion = null): void
    {
        $this->completion = $completion;
        $this->checklist_id = $completion->checklist_id ?? '';
        $this->disaster_event_id = $completion->disaster_event_id ?? '';
        $this->completed_items = $completion->completed_items ?? [];
        $this->notes = $completion->notes ?? '';
        $this->completed_at = $completion->completed_at ? $completion->completed_at->format('Y-m-d H:i') : now()->format('Y-m-d H:i');
    }

    public function rules(): array
    {
        return [
            'checklist_id' => ['required', 'exists:preparedness_checklists,id'],
            'disaster_event_id' => ['nullable', 'exists:disaster_events,id'],
            'completed_items' => ['required', 'array', 'min:1'],
            'notes' => ['nullable', 'string'],
            'completed_at' => ['required', 'date'],
        ];
    }

    public function save(): void
    {
        $this->validate();

        $data = $this->only([
            'checklist_id',
            'disaster_event_id',
            'completed_items',
            'notes',
        ]);

        // Convert empty strings to null
        $data['disaster_event_id'] = $data['disaster_event_id'] === '' ? null : $data['disaster_event_id'];
        $data['completed_at'] = $this->completed_at;

        if (!$this->completion) {
            $data['completed_by'] = auth()->id();
            ChecklistCompletion::create($data);
        } else {
            $this->completion->update($data);
        }

        $this->reset();
    }
}

