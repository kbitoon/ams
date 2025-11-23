<?php

namespace App\Livewire\Modals;

use App\Models\DisasterReport;
use LivewireUI\Modal\ModalComponent;

class DisasterReportViewModal extends ModalComponent
{
    public ?DisasterReport $report = null;

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function mount(DisasterReport $report = null): void
    {
        if ($report && $report->exists) {
            $this->report = $report->load(['disasterEvent', 'generatedBy']);
        }
    }

    public function render()
    {
        return view('livewire.modals.disaster-report-view-modal');
    }
}
