<?php

namespace App\Livewire\Forms;

use App\Models\DisasterReport;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class DisasterReportForm extends Form
{
    public ?DisasterReport $disasterReport = null;

    public string $disaster_event_id = '';
    public string $report_type = 'situation';
    public string $title = '';
    public string $content = '';
    public string $report_date = '';
    public array $attachments = [];

    public function setDisasterReport(?DisasterReport $disasterReport = null): void
    {
        $this->disasterReport = $disasterReport;
        $this->disaster_event_id = $disasterReport->disaster_event_id ?? '';
        $this->report_type = $disasterReport->report_type ?? 'situation';
        $this->title = $disasterReport->title ?? '';
        $this->content = $disasterReport->content ?? '';
        $this->report_date = $disasterReport->report_date ? $disasterReport->report_date->format('Y-m-d') : now()->format('Y-m-d');
        $this->attachments = $disasterReport->attachments ?? [];
    }

    public function rules(): array
    {
        return [
            'disaster_event_id' => ['required', 'exists:disaster_events,id'],
            'report_type' => ['required', 'in:situation,damage_assessment,recovery_progress,final'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'report_date' => ['required', 'date'],
            'attachments' => ['nullable', 'array'],
        ];
    }

    public function save(): void
    {
        $this->validate();

        $data = $this->only([
            'disaster_event_id',
            'report_type',
            'title',
            'content',
            'report_date',
            'attachments',
        ]);

        if (!$this->disasterReport) {
            $data['generated_by'] = auth()->id();
            DisasterReport::create($data);
        } else {
            $this->disasterReport->update($data);
        }

        $this->reset();
    }
}

