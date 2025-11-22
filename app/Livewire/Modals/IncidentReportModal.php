<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\IncidentReportForm;
use App\Models\IncidentReport;
use Illuminate\Contracts\View\View;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class IncidentReportModal extends ModalComponent
{
    use WithFileUploads;

    public ?IncidentReport $incidentReport = null;
    public IncidentReportForm $form;

    public function mount(IncidentReport $incidentReport = null): void
    {
        if ($incidentReport && $incidentReport->exists) {
            $this->form->setIncidentReport($incidentReport);
        } else {
            // Set default date to today for new reports
            $this->form->date = now()->format('Y-m-d');
        }
    }

    public function save(): void
    {
        $this->form->save();
        $this->closeModal();
        $this->dispatch('refresh-list');
    }

    public function render(): View
    {
        return view('livewire.forms.incident-report-form');
    }
}
