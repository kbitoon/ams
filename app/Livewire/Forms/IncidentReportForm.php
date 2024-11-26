<?php

namespace App\Livewire\Forms;

use App\Models\IncidentReport;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class IncidentReportForm extends Form
{
    public ?IncidentReport $incidentReport = null;

    public string $title = '';
    public string $name = '';
    public string $narration = '';
    public string $date = '';
    public int $user_id = 1;

    /**
     * @param IncidentReport|null $incidentReport
     */
    public function setIncidentReport(?IncidentReport $incidentReport = null): void
    {
        $this->incidentReport = $incidentReport;
        $this->title = $incidentReport->title;
        $this->name = $incidentReport->name;
        $this->narration = $incidentReport->narration;
        $this->date = $incidentReport->date;
    }

    /**
     * @return string[][]
     */
    public function rules(): array
    {
        return [
            'title' => ['required'],
            'name' => ['required'],
            'narration' => ['required'],
            'date' => ['required', 'date'],
        ];
    }

    /**
     * @return string[]
     */
    public function validationAttributes(): array
    {
        return [
            'title' => 'title',
            'name' => 'name',
            'narration' => 'narration',
            'date' => 'date',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();
        if (!$this->incidentReport) {
            if (auth()->user()) {
            $this->incidentReport = auth()->user()->incidentReports()->create($this->only(['title','user_id','name', 'narration', 'date']));
            } else {
            $incidentReport = IncidentReport::create($this->only(['title','user_id','name', 'narration', 'date']));
            }
        } else {
            $this->incidentReport->update($this->only(['title','name', 'narration', 'date']));
        }
        $this->reset();
    }
}
