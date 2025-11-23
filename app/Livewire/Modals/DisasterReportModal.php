<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\DisasterReportForm;
use App\Models\DisasterReport;
use App\Models\DisasterEvent;
use LivewireUI\Modal\ModalComponent;

class DisasterReportModal extends ModalComponent
{
    public ?DisasterReport $disasterReport = null;
    public DisasterReportForm $form;

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function mount(DisasterReport $report = null, DisasterEvent $event = null): void
    {
        if ($report && $report->exists) {
            $this->disasterReport = $report;
            $this->form->setDisasterReport($report);
        } elseif ($event && $event->exists) {
            $this->form->disaster_event_id = $event->id;
        }
    }

    public function save(): void
    {
        $this->form->save();
        $this->closeModal();
        $this->dispatch('refresh-list');
    }

    public function render()
    {
        return view('livewire.modals.disaster-report-modal', [
            'events' => DisasterEvent::orderBy('title')->get(),
        ]);
    }
}
