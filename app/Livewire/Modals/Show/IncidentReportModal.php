<?php

namespace App\Livewire\Modals\Show;

use App\Models\IncidentReport;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use LivewireUI\Modal\ModalComponent;

class IncidentReportModal extends ModalComponent
{
    public ?IncidentReport $incidentReport = null;

    /**
     * @param IncidentReport|null $incidentReport
     */
    public function mount(IncidentReport $incidentReport = null): void
    {
        if ($incidentReport && $incidentReport->exists) {
            $this->incidentReport = $incidentReport;
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function render()
    {
        return view('livewire.incident-report.view', [
            'incidentReport' => $this->incidentReport,
        ]);
    }
}
