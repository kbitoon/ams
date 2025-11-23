<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\DisasterAlertForm;
use App\Models\DisasterAlert;
use App\Models\DisasterEvent;
use LivewireUI\Modal\ModalComponent;

class DisasterAlertModal extends ModalComponent
{
    public ?DisasterAlert $disasterAlert = null;
    public DisasterAlertForm $form;

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }

    public function mount(DisasterAlert $alert = null, DisasterEvent $event = null): void
    {
        if ($alert && $alert->exists) {
            $this->disasterAlert = $alert;
            $this->form->setDisasterAlert($alert);
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
        return view('livewire.modals.disaster-alert-modal', [
            'events' => DisasterEvent::where('status', 'active')->orderBy('title')->get(),
        ]);
    }
}
